@extends('layouts.app')

@section('title', 'ログイン')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('header-button')
<a class="header__link" href="/register">register</a>
@endsection

@section('content')
<div class="auth">
    <h2 class="auth__title">Login</h2>

    <form class="auth-form" action="/login" method="post" novalidate>
        @csrf

        <div class="auth-form__group">
            <label class="auth-form__label">メールアドレス</label>

            <input
                class="auth-form__input"
                type="text"
                name="email"
                value="{{ old('email') }}"
            >

            @error('email')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-form__group">
            <label class="auth-form__label">パスワード</label>

            <input
                class="auth-form__input"
                type="password"
                name="password"
            >

            @error('password')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-form__button">
            <button class="auth-form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection