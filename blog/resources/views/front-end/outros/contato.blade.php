@extends('layouts.master')

@section('title')
    Contato
@endsection

@section('styles')
    <link rel="stylesheet" href="{{URL::asset('src/css/form.css')}}">
@endsection

@section('content')
    @include('includes.info-box')
    <form action="{{ route('contact.send') }}" method="post" id="form-contact">
        <div class="input-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" value="{{ Request::old('name') }}"/>
        </div>
        <div class="input-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="{{ Request::old('email') }}"/>
        </div>
        <div class="input-group">
            <label for="subject">Assunto</label>
            <input type="text" name="subject" id="subject" value="{{ Request::old('subject') }}"/>
        </div>
        <div class="input-group">
            <label for="message">Mensagem</label>
            <textarea name="message" id="message" rows="10">
                {{ Request::old('message') }}
            </textarea>
        </div>
        <button type="submit" class="btn">Enviar</button>
        <input type="hidden" name="_token" value="{{Session::token()}}" />
    </form>
@endsection