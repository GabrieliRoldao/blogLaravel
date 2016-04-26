@extends('layouts.admin-master')

@section('content')
    <div class="container">
        <section id="post-admin">
            <a href="{{route('admin.blog.post.edit',['post_id' => $post->id])}}">Editar</a>
            <a href="{{route('admin.blog.post.delete', ['post_id' => $post->id])}}">Deletar</a>
        </section>
        <section class="post">
            <h1>{{ $post->title}}</h1>
            <span class="info">{{ $post->author }} | {{ $post->created_at }}</span>
            <p>{{ $post->body }}</p>
        </section>
    </div>
@endsection