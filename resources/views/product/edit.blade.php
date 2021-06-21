@extends('layouts.app')

@section('content')
    <div class="row ml-4">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-primary">Update Product</h2>
            </div>
            <div class="pull-right mr-5">
                <a class="btn btn-primary" href="{{ route('product.index') }}">Back</a></div>
        </div>
    </div>

    <form data-product-id="{{ $productsAll->id }}" class="ml-5 products main" enctype="multipart/form-data">
        @csrf
        <div class="modal-main container">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-flex">


                        <div id="form" class="modal-header">
                            <strong>Images</strong>
                            <input id="upload_images" type="file" multiple name="upload_images[]" class="form-control">

                            <div>
                                <div class="modal-slick modal-img-group" id="m-img">
                                    <div class="preview">
                                        @foreach($productsAll->images as $image)
                                            <div class="img-div">
                                                <i>x</i>
                                                <img
                                                    class="data-images images-choose @if($image->is_main)img-style @endif"
                                                    src="{{ asset('/storage/uploads/' . $image->url) }}"
                                                    @if($image->is_main)data-main="{{ $image->is_main }}"
                                                    @endif data-id="{{ $image->id }}"/>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                @foreach($productsAll->images as $image)
                                    @if($image->is_main != 0)
                                        <img class="modal-img mt-3" src="{{ asset('storage/uploads/' . $image->url) }}" alt="modal">
                                    @endif
                                @endforeach
                            </div>
                            <em data-error="isMain"></em>
                        </div>

                        <div class="modal-bod">

                            <div class="form-group">
                                <span>Name</span>
                                <input id="name" type="text" name="name" class="form-control" placeholder="Name"
                                       data-id="1"
                                       value="{{ $productsAll->name }}">
                                <em data-error="name"></em>
                            </div>

                            <div class="form-group">
                                <span>Brand:</span>
                                <input id="brand" type="text" name="brand" class="form-control" placeholder="brand"
                                       value="{{ $productsAll->brand }}">
                                <em data-error="brand"></em>
                            </div>

                            <div class="form-group">
                                <span>Price:</span>
                                <input id="price" type="number" name="price" class="form-control"
                                       placeholder="Put the price"
                                       value="{{ $productsAll->price }}">
                                <em data-error="price"></em>
                            </div>

                            <div class="many">
                                <div class="form-group">
                                    <span>Description:</span>
                                    <textarea id="description" class="form-control" style="height:50px"
                                              name="description"
                                              placeholder="description">{{ $productsAll->description }}</textarea>
                                    <em data-error="description"></em>
                                </div>
                            </div>

                            <div class="my-2">
                                <div class="d-flex my-1 main-color">
                                    @foreach($colors as $color)
                                        <div class="color-div">
                                            <div
                                                class="color @foreach($productsAll->colors as $prod){{ $color->id == $prod->id ? 'new-border' : '' }} @endforeach"
                                                style="background: {{ $color->color }}"></div>
                                            <input class="input-check" type="checkbox" name="selected_colors[]"
                                                   @foreach($productsAll->colors as $prod){{ $color->id == $prod->id ? ' checked' : ''}}@endforeach value="{{$color->id}}">
                                        </div>
                                    @endforeach
                                </div>
                                <em data-error="colorArr"></em>
                            </div>

                            <div class="form-group my-2">
                                <select id="size">
                                    <option> --- Select Size ---</option>
                                    @foreach($sizes as $size)
                                        <option
                                            @foreach($productsAll->sizes as $sizId) {{ $size->id == $sizId->id ? 'selected': '' }} @endforeach value="{{$size->id}}"> {{ $size->size }} </option>
                                    @endforeach
                                </select>
                                <em data-error="sizeValue"></em>
                            </div>


                            <div class="form-group my-2">
                                <select class="form-select form-select-sm" id="category" name="category_id">
                                    @foreach($categorys as $category)
                                        <option
                                            {{ $category->id == $productsAll->category_id ? 'selected' : '' }} type="checkbox"
                                            value="{{$category->id}}">{{$category->name}}</option>
                                        @include('product.update', ['category' => $category])
{{--                                        @if ($category->children)--}}
{{--                                            @foreach ($category->children as $child)--}}
{{--                                                <option--}}
{{--                                                    {{ $child->id == $productsAll->category_id ? 'selected' : '' }} value="{{ $child->id }}">--}}
{{--                                                    &nbsp;&nbsp;-{{ $child->name }}</option>--}}
{{--                                            @endforeach--}}
{{--                                        @endif--}}
                                    @endforeach
                                </select>
                                <em data-error="categoryValue"></em>
                            </div>
                            <div id="images-button">
                                <button type="button" id="update-button" class="btn btn-primary">Update Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
