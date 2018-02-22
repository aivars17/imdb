@extends('admin.dashboard')
@section('admin')
    <div class="container">
        <form method="post" action="{{ route('edit_cat') }}">
            @csrf
            <div class="form-group">
                <label for="categories">Exist Categories</label>
                <select name="category"  onchange="this.form.submit()" class="form-control col-2" id="exampleFormControlSelect1">
                    <option></option>
                    @foreach($cats as $cat)
                        <option @isset($data) @if($data->name == $cat->name)  selected @endif @endisset value="{{ $cat->name }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
        </form>

        <form action="{{ empty($data) ? route('category_save') : route('update_cat', $data->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="formGroupExampleInput">Category name</label>
                <input class="col-2" type="text" class="form-control" name="name" value="{{ !empty($data) ? $data->name : '' }}" id="formGroupExampleInput" >
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="6">{{ !empty($data) ? $data->description : '' }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">{{ empty($data) ? 'Save' : 'Update' }}</button>
            @if(!empty($data))
            <a href="{{ route('create_category') }}" class="btn btn-secondary">Create new</a>
            <a href="{{ route('category_delete', $data->id) }}" class="btn btn-secondary">Delete</a>
                @endif
        </form>

        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    </div>
@endsection