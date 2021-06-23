@extends('admin.admin')

@section('content_admin')
    <div class="color-group">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-success ml-5">Product Crud</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

           <div class="m-2"><a class="btn btn-success" href="{{ route('color.create') }}">Add Color</a></div>

    <table class="table table-bordered color-table">
        <tr>
            <th>No</th>
            <th>color</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        @foreach($colors as $index => $color)
            <tr>
                {{--                <form action="{{ route('product.destroy',$product->id) }}" method="POST">--}}

                <td>{{ $index+1 }}</td>
                <td><div class="index-color" style="background: {{ $color->color }}"></div></td>
                {{--
                       <a class="btn btn-info" href="{{ route('product', ['id'=>$product->id]) }}">Show</a>--}}
                <td>
                    <a class="btn btn-primary">Edit</a>
{{--                    <a class="btn btn-primary" href="{{ route('color.edit') }}">Edit</a>--}}
                </td>
                <td>
                    @csrf
                    @method('DELETE')

                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                </td>
            </tr>
        @endforeach
    </table>
    </div>

@endsection
