@extends('layouts.admin-master')

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('src/css/form.css') }}" type="text/css" />
@endsection

@section('content')
    <div class="container">
        @include('includes.info-box')
        <form action="{{route('admin.blog.post.create')}}" method="post">
            <div class="input-group">
                <label for="title">Titulo</label>
                <input type="text" name="title" id="title" {{$errors->has('title') ? 'class=has-error' : ''}} 
                value = "{{Request::old('title')}}"/>
            </div>
            <div class="input-group">
                <label for="author">Autor</label>
                <input type="text" name="author" id="author" {{$errors->has('author') ? 'class=has-error' : ''}} 
                value ="{{Request::old('author')}}"/>
            </div>
            <div class="input-group">
                <label for="category_select">Categorias</label>
                <select name="category_select" id="category_select">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="btn">Adicionar categoria</button>
                <div class="added-categories">
                    <ul></ul>
                </div>
                <input type="hidden" name="categories" id="categories" />
            </div>
            <div class="input-group">
                <label for="body">Post</label>
                <textarea name="body" id="body" rows="12" {{$errors->has('body') ? 'class=has-error' : ''}}>{{Request::old('body')}}</textarea>
            </div>
            <button type="submit" class="btn">Criar post</button>
            <input type="hidden" name="_token" value="{{Session::token()}}"/>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>   
    <script src="{{URL::asset('src/js/posts.js')}}"></script>
@endsection