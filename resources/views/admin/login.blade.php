@extends('layout.initialize')
@section('title') ورود @endsection
@section('body')

    @if(Session::has('message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" dir="rtl">
            <strong>{{ Session::get('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <livewire:admin-login/>
@endsection
