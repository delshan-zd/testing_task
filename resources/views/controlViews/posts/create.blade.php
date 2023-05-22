@extends('layouts.app')

@section('content')

    <div class="container col-8 offset-2">
        <form action="/posts/store" enctype="multipart/form-data" method="post">
            @csrf
            <div class="row form-group">
                <label for="caption" class="col-form-label text-md-end">{{ __('title') }}</label>
                <input id="caption" type="text" class="form-control @error('title') is-invalid @enderror" name="title" autofocus>
            </div>

            <div class="row form-group">
                <label for="caption" class="col-form-label text-md-end">{{ __('body') }}</label>
                <input id="caption" type="text" class="form-control @error('body') is-invalid @enderror" name="body" autofocus>
            </div>

            <div class="row form-group">
                <label for="image" class="col-form-label text-md-end">{{ __('image') }}</label>
                <input id="image" type="file" class="form-control-file @error('image') is-invalid @enderror" name="image"  autofocus>
            </div>
            <select class="form-control"
                    name="category_id">

                @foreach($categories as $category)
                    <option value="{{$category->id}}">
                        {{$category->title}}  </option>
                @endforeach

            </select>
            <button type="submit"> send </button>
        </form>
    </div>
@endsection
