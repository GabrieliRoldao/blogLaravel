@extends('layouts.admin-master')

@section('styles')
    <link rel="stylesheet" href="{{URL::asset('src/css/modal.css')}}" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
@endsection

@section('content')
    <div class="container">
        <section class="list">
            @if(count($contact_messages) === 0)
                Não possui mensagens!
            @endif
            @foreach($contact_messages as $contact_message)
            <article data-message="{{ $contact_message->body }}" data-id="{{ $contact_message->id }}" class="contact-message">
                    <div class="message-info">
                        <h3>{{ $contact_message->subject }}</h3>
                        <span class="info">Sender: {{ $contact_message->sender }} | {{ $contact_message->created_at }}</span>
                    </div>
                    <div class="edit">
                        <nav>
                            <ul>
                                <li class="view"><a href="#">Visualizar</a></li>
                                <li class="delete"><a href="#" class="danger">Excluir</a></li>
                            </ul>
                        </nav>
                    </div>
                </article>
            @endforeach
        </section>         
        @if($contact_messages->lastPage() > 1)
            <section class="pagination">
                @if($contact_messages->currentPage() !== 1)
                    <a href="{{ $contact_messages->previousPageUrl() }}"><i class="fa fa-caret-left"></i></a>
                @endif
                @if($categories->currentPage() !== $categories->lastPage())
                    <a href="{{ $contact_messages->nextPageUrl() }}"><i class="fa fa-caret-right"></i></a>
                @endif
            </section>
        @endif
    </div>
    <div class="modal" id="contact-message-modal">
        <button class="btn" id="modal-close">x</button>
    </div>
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script type="text/javascript">
        var token = "{{ Session::token() }}";
    </script>
    <script src="{{URL::asset('src/js/modal.js')}}"></script>
    <script src="{{URL::asset('src/js/contact_messages.js')}}"></script>
@endsection