@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-success ml-5">Product Crud</h2>
            </div>
            <div class="pull-right mr-5 mb-4">
                <div>
                    <a class="btn btn-success" href="{{ route('product.create') }}"> Create New Product</a>
                </div>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $index => $product)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->brand }}</td>
                <td>
                    <form action="{{ route('product.destroy',$product->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ url('product/display', ['id'=>$product->id]) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('product.edit', $product->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">Delete</button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body text-primary">
                                       <em>Are you sure you want to delete product!</em>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>





                    </form>
                </td>
            </tr>
        @endforeach
    </table>


@endsection
