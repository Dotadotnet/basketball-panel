@extends('errors::minimal')

@section('title', 'غیر مجاز' ?: __('Unauthorized'))
@section('code', '401')
@section('message', $exception->getMessage() ?: __('Unauthorized'))
