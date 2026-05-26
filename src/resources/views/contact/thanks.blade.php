@extends('layouts.app')

@section('title', 'お問い合わせ完了')

@section('css')
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks">
    <div class="thanks__background">Thank you</div>

    <div class="thanks__content">
        <p class="thanks__message">お問い合わせありがとうございました</p>
        <a class="thanks__button" href="/">HOME</a>
    </div>
</div>
@endsection