<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Image;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('id', 'name', 'brand')->paginate(5);;
        return view('product.index', compact('products'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $color = Color::all();
        $size = Size::all();
        $category = Category::all()->load('children');

        return view('product.create', [
            'colors' => $color,
            'sizes' => $size,
            'categorys' => $category
        ]);
    }

    public function store(ProductRequest $request)
    {
        $user = Auth::user();
        $product = Product::create([
            'user_id' => $user->id,
            'category_id' => $request['category_id'],
            'name' => $request['name'],
            'description' => $request['description'],
            'brand' => $request['brand'],
            'price' => $request['price']
        ]);

        foreach ($request['colorArr'] as $color) {
            $product->colors()->attach($color);
        }

        $product->sizes()->attach($request['sizeValue']);

        if ($request['imagesArr']) {
            foreach ($request['imagesArr'] as $index => $file) {
                $fileOriginalName = $file->getClientOriginalName();
                $imageFileNewName = time() . '_' . $fileOriginalName;
                $file_name = $file->storeAs('uploads', $imageFileNewName, 'public');
                $newImages = '/storage/' . $file_name;
                $image = Image::create([
                    "url" => $imageFileNewName,
                    "is_main" => $index == $request['isMain'] && 1
                ]);
                $product->images()->attach($image->id);
            }
        }

        return response()->json($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,$id)
    {
        $productId = $product->find($id);
        $category = Category::with('product', 'children')->where('parent_id', 0)->get();

        $productsAll = $productId->load(['colors', 'sizes', 'images']);

        return view('product.show', compact('productsAll','category'));
    }

    public function edit(Product $product)
    {
        $colors = Color::all();
        $sizes = Size::all();
        $categorys = Category::all()->load('children');
        $productsAll = $product->load(['colors', 'sizes', 'images']);

        return view('product.edit', compact('productsAll',
            'colors', 'sizes', 'categorys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */

    public function update(ProductUpdateRequest $request, Product $product, $id)
    {
       $updateProduct = $product->find($id);
       $updateProduct->update($request->all());

        if ($request['colorArr']) {
            $updateProduct->colors()->detach();
            foreach ($request['colorArr'] as $color) {
                $updateProduct->colors()->attach($color);
            }
        }

        if ($request['sizeValue']) {
            $updateProduct->sizes()->detach();
            $updateProduct->sizes()->attach($request['sizeValue']);
        }


        if ($request['imagesArr']) {
            foreach ($request['imagesArr'] as $index => $file) {
                $fileOriginalName = $file->getClientOriginalName();
                $imageFileNewName = time() . '_' . $fileOriginalName;
                $file_name = $file->storeAs('uploads', $imageFileNewName, 'public');
                $newImages = '/storage/' . $file_name;
                $image = Image::create([
                    "url" => $imageFileNewName
                ]);

                $updateProduct->images()->attach($image->id);
            }
        }
        $mainImage = $updateProduct->load(['images']);
        foreach ($mainImage->images as $index => $image) {
            $image->update([
                'is_main' => $request['isMain'] == $index ? 1 : 0
            ]);
        }

        return response()->json($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->colors()->detach();
        $product->sizes()->detach();
        $product->delete();
        return redirect()->route('product.index')
            ->with('success','Product deleted successfully');
    }
}
