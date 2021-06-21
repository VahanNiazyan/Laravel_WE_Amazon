<div>
    @if (count($category->children) > 0)
        @foreach ($category->children as $child)
            <option {{ $child->id == $productsAll->category_id ? 'selected' : '' }} value="{{ $child->id }}">
                &nbsp;&nbsp;-{{ $child->name }}</option>
{{--            @include('product.update', ['category' => $child])--}}
        @endforeach
    @endif
</div>
