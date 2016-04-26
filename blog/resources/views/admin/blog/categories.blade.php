@extends('layouts.admin-master')

@section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{URL::to('src/css/categories.css')}}" type="text/css" />
@endsection

@section('content')    
    <div class="container">
        <section id="category-admin">
            <form action="" method="post">
                <div class="input-group">
                    <label for="name">Nome da categoria</label>
                    <input type="text" name="name" id="name" />
                    <button type="submit" class="btn" id="btn">Criar categoria</button>
                </div>
            </form>
        </section>
        <section class="list">
            @foreach($categories as $category)
                <article>
                    <div class="category-info" data-id="{{ $category->id }}">
                        <h3>{{ $category->name }}</h3>
                    </div>
                    <div class="edit">
                        <nav>
                            <ul>
                                <li class="category-edit"><input type="text" class="categoria"/></li>
                                <li class="editar"><a href="#">Editar</a></li>
                                <li class="excluir"><a href="#" class="danger">Excluir</a></li>
                            </ul>
                        </nav>
                    </div>
                </article>
            @endforeach
        </section>         
        @if($categories->lastPage() > 1)
            <section class="pagination">
                @if($categories->currentPage() !== 1)
                    <a href="{{ $categories->previousPageUrl() }}"><i class="fa fa-caret-left"></i></a>
                @endif
                @if($categories->currentPage() !== $categories->lastPage())
                    <a href="{{ $categories->nextPageUrl() }}"><i class="fa fa-caret-right"></i></a>
                @endif
            </section>
        @endif
    </div>   
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script type="text/javascript">
        var token = "{{ Session::token() }}";
    </script>
    <script src="{{URL::asset('src/js/categories.js')}}"></script>
@endsection