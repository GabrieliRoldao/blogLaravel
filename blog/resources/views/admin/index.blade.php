@extends('layouts.admin-master')

@section('styles')
    <link rel="stylesheet" href="{{URL::asset('src/css/modal.css')}}" type="text/css" />
@endsection

@section('content')
    <div class="container">
        @include('includes.info-box')
        <div class="card">
            <header>
                <nav>
                    <ul>
                        <li><a href="{{ route('admin.blog.create_post') }}" class="btn">Novo post</a></li>
                        <li><a href="{{ route('admin.blog.index') }}" class="btn">Visualizar todos os posts</a></li>
                    </ul>
                </nav>
            </header>
            <section>
                <ul>
                    @if(count($posts) == 0)
                        <li>Nenhum post criado</li>
                    @else    
                        @foreach($posts as $post)
                            <li>
                                <article>
                                    <div class="post-info">
                                        <h3>{{ $post->title }}</h3>
                                        <span class="info">{{ $post->author }} | {{ $post->created_at }}</span>
                                    </div>
                                    <div class="edit">
                                        <nav>
                                            <ul>
                                                <li><a href="{{route('admin.blog.post', ['post_id' => $post->id, 'end' => 'admin'])}}">Visualizar</a></li>
                                                <li><a href="{{route('admin.blog.post.edit',['post_id' => $post->id])}}">Editar</a></li>
                                                <li><a href="{{route('admin.blog.post.delete', ['post_id' => $post->id])}}" class="danger">Excluir</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                </article>
                            </li>
                        @endforeach                        
                    @endif
                </ul>
            </section>
        </div>
        
        <div class="card">
            <header>
                <nav>
                    <ul>
                        <li><a href="{{ route('admin.contact.index') }}" class="btn">Visualizar todas as mensagens</a></li>
                    </ul>
                </nav>
            </header>
            <section>
                <ul>
                    @if(count($contact_messages) == 0)
                        <li>Não há mensagens</li>
                    @endif
                    @foreach($contact_messages as $contact_message)
                        <li>
                            <article data-message="{{ $contact_message->body }}" data-id="{{ $contact_message->id }}" class="contact-message">
                                <div class="message-info">
                                    <h3>{{ $contact_message->subject }}</h3>
                                    <span class="info">Enviada por: {{ $contact_message->sender }}| {{ $contact_message->created_at }}</span>
                                </div>
                                <div class="edit">
                                    <nav>
                                        <ul>
                                            <li class="view"><a href="">Visualizar</a></li>
                                            <li class="delete"><a href="" class="danger">Excluir</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </article>
                        </li>
                    @endforeach    
                </ul>
            </section>
        </div>
    </div>
    <div class="modal" id="contact-message-modal">
        <button class="btn" id="modal-close">x</button>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script type="text/javascript">
        var token = "{{Session::token()}}";
    </script>
    <script src="{{URL::asset('src/js/modal.js')}}"></script>
    <script src="{{URL::asset('src/js/contact_messages.js')}}"></script>
@endsection