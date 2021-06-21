@extends('layouts.app')

@section('content')
    <div class="row ml-5">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-primary">Add New Product</h2>
            </div>
            <div class="pull-right mr-5">
                <a class="btn btn-primary" href="{{ route('product.index') }}">Back</a></div>
        </div>
    </div>

    <form class="products main" enctype="multipart/form-data">
        <div class="modal-main container">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-flex">
                        @csrf
                        <div id="form" class="form-group modal-header">
                            <div>
                                <div class="modal-slick modal-img-group" id="m-img">
                                    <input id="upload_images" type="file" multiple name="upload_images[]"
                                           class="form-control">
                                    <em data-error="isMain"></em>
                                    <div class="preview"></div>
                                </div>
                                <img class="modal-img mt-3" src="" alt="modal">
                            </div>
                        </div>


                        <div class="modal-bod">

                            <div class="form-group">
                                <span>Name</span>
                                <input id="name" type="text" name="name" class="form-control" placeholder="Name"
                                       data-id="1" value="{{ old('name') }}">
                                <em data-error="name"></em>
                            </div>

                            <div class="form-group">
                                <span>Brand:</span>
                                <input id="brand" type="text" name="brand" class="form-control" placeholder="brand"
                                       value="{{ old('brand') }}">
                                <em data-error="brand"></em>
                            </div>

                            <div class="form-group">
                                <span>Price:</span>
                                <input id="price" type="number" name="price" class="form-control"
                                       placeholder="Put the price" value="{{ old('price') }}">
                                <em data-error="price"></em>
                            </div>

                            <div class="many">
                                <div class="form-group">
                                    <span>Description:</span>
                                    <textarea id="description" class="form-control" style="height:50px"
                                              name="description"
                                              placeholder="description" value="{{ old('description') }}"></textarea>
                                    <em data-error="description"></em>
                                </div>
                            </div>

                            <div class="my-2">
                                <div class="d-flex my-1 main-color">
                                    @foreach($colors as $color)
                                        <div class="color-div">
                                            <div class="color" style="background: {{ $color->color }}"></div>
                                            <input id="color" class="input-check" type="checkbox"
                                                   name="selected_colors[]" value="{{$color->id}}">
                                        </div>
                                    @endforeach
                                </div>
                                <em data-error="colorArr"></em>
                            </div>

                            <div class="form-group my-2">
                                <select id="size">
                                    <option selected disabled hidden>--- Select Size ---</option>
                                    @foreach($sizes as $size)
                                        <option value="{{$size->id}}"> {{ $size->size }} </option>
                                    @endforeach
                                </select>
                                <em data-error="sizeValue"></em>
                            </div>

                            <div class="form-group my-2">
                                <select class="form-select form-select-sm" id="category" name="category_id">
                                    <option selected disabled hidden>--- Select Category ---</option>
                                    @foreach($categorys as $category)
                                        <option type="checkbox" value="{{$category->id}}">{{ $category->name }}</option>
                                        @if ($category->children)
                                            @foreach ($category->children as $child)
                                                <option value="{{ $child->id }}">
                                                    --{{ $child->name }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                                <em data-error="category_id"></em>
                            </div>
                            <div id="images-button" class="col-xs-12 col-sm-12 col-md-12">
                                <button type="button" id="create-button" class="btn btn-primary">Add Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


@endsection
