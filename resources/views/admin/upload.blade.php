@extends('admin.dashboard')

@section('admin')
    <form action="{{ $img_category == 'actor' ? route('actor_image_store', $id) : route('movie_image_store', $id) }}" method="post" enctype="multipart/form-data">
        @csrf
    <label for="input-25">IMage</label>
    <div class="file-loading">
        <input id="input-25" name="input25" type="file" multiple>
    </div>
    <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    @endsection