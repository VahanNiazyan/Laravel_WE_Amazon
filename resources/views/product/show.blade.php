@extends('layouts.app')


@section('content')
    <div class="row ml-5">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-primary">Show Product</h2>
            </div>
            <div class="pull-right mr-5">
                <a class="btn btn-primary" href="{{ route('product.index') }}">Back</a></div>
        </div>
    </div>

    <div class="modal-main container">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-flex">
                    <div class="modal-header">
                        @foreach($productsAll->images as $image)
                            @if($image->is_main != 0)
                                <img class="modal-img" src="{{ asset('/storage/uploads/' . $image->url) }}" alt="modal">
                            @endif
                        @endforeach
                        <div class="modal-slick modal-img-group" id="m-img">
                            @foreach($productsAll->images as $image)
                                <a>
                                    <img class="images-choose @if($image->is_main)img-style @endif" src="{{ asset('storage/uploads/' . $image->url) }}"/>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="modal-bod">
                        <h3><span class="span-desc">Name: </span> {{ $productsAll->name }}</h3>

                        <div class="star-icon">
                            <i class="fa fa-star ico"></i>
                            <i class="fa fa-star ico"></i>
                            <i class="fa fa-star ico"></i>
                            <i class="fa fa-star ico"></i>
                            <i class="fa fa-star ico5"></i>
                        </div>

                        <ul>
                            <li>Brand: <a>{{ $productsAll->brand }}</a></li>
                        </ul>

                        <div class="many">
                            <span class="many-s1">Price:</span>
                            <span class="many-s2">{{ $productsAll->price }}</span>
                        </div>

                        <div class="my-2">
                            <span class="span-desc">Category: </span>
                            @foreach($category as $cat)
                                <span>{{ $cat->name }}, </span>
                            @endforeach
                        </div>

                        <div>
                            <span class="span-desc">Description: </span>
                            <h6 class="d-inline"><span>{{ $productsAll->description }}</span></h6>
                        </div>

                        <div class="form-group">
                            <label>
                                <sup>*</sup>
                                Color
                            </label>
                            <div class="d-flex">
                                @foreach($productsAll->colors as $color)
                                    <div class="color-div">
                                        <div
                                            class="color @foreach($productsAll->colors as $prod){{ $color->id == $prod->id ? 'new-border' : '' }} @endforeach"
                                            style="background: {{ $color->color }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="span-desc">Size: </span>
                            @foreach($productsAll->sizes as $size)
                                <span> {{ $size->size }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
