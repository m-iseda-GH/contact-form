@extends('layouts.app')

@section('title', '会員登録')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
<div class="auth">
    <h2 class="auth__title">Register</h2>

    <form class="auth-form" action="/register" method="post" novalidate>
        @csrf

        <div class="auth-form__group">
            <label class="auth-form__label">お名前</label>
            <input class="auth-form__input" type="text" name="name" value="{{ old('name') }}">

            @error('name')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-form__group">
            <label class="auth-form__label">メールアドレス</label>
            <input class="auth-form__input" type="text" name="email" value="{{ old('email') }}">

            @error('email')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-form__group">
            <label class="auth-form__label">パスワード</label>
            <input class="auth-form__input" type="password" name="password">

            @error('password')
                <p class="form__error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-form__button">
            <input class="auth-form__button-submit" type="submit" value="登録">
        </div>
    </form>
</div>
@endsection