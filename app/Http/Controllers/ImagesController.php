<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function update($productId, $id)
    {
//        $mainImage = $updateProduct->load(['images' => function ($query) {
//            dd($query->where('is_main', 0));
////            $query->where('is_main', 0);
//        }]);

//        $updateProduct = Product::find($productId);
//        $mainImage = $updateProduct->load(['images']);
//        foreach ($updateProduct->images as $image) {
//            $image->update([
//                'is_main' => 0
//            ]);
//        }
//        $image = Image::find($id);
//        $image->update([
//            "is_main" => 1
//        ]);

    }

    public function delete($id)
    {
        $image = Image::find($id);
        if ($image) {
            $image->delete();
            return response()->noContent();
        } else {
            return response()->json([
                'message' => 'Image not found'
            ], 400);
        }
    }
}
