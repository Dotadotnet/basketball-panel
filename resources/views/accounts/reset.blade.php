@extends('layout.initialize')
@section('title') ایجاد رمز جدید @endsection
@section('body')

    @if(Session::has('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" dir="rtl">
            <strong>{{ Session::get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(is_null($message))
        @livewire('reset-password-accounts', ['url' => $forgot->url])
    @else
        <h1 class="text-center justify-content-center" style="color: red">{{ $message }}</h1>
        <h1 class="text-center justify-content-center"><a class="text-decoration-none" href="{{ route('forgot.password') }}">ایجاد رمز جدید</a></h1>
    @endif
@endsection
