@extends('admin.admin')

@section('content_admin')
    <form action="{{ route('color.store') }}" method="POST">
        @if(Session::get('fail'))
            <div class="alert alert-danger">{{Session::get('fail')}}</div>
        @endif
        @csrf
        <div class="admin-color">
            <label>Color</label>
            <input name="color" type="color">
        </div>
            <div class="form-group mt-4">
                <input type="submit" value="Add Color" class="btn btn-primary">
            </div>
    </form>
@endsection
