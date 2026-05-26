@extends('layouts.app')

@section('title', 'お問い合わせフォーム')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="contact">
    <h2 class="contact__title">Contact</h2>

    <form class="form" action="/confirm" method="post" novalidate>
        @csrf

        <div class="form__group">
            <label class="form__label">お名前 <span class="form__required">※</span></label>
            <div class="form__input-area">
                <div class="form__name-inputs">
                    <input class="form__input" type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                    <input class="form__input" type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                </div>

                @error('last_name')
                    <p class="form__error">{{ $message }}</p>
                @enderror

                @error('first_name')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <label class="form__label">性別 <span class="form__required">※</span></label>
            <div class="form__input-area">
                <div class="form__radio-group">
                    <label>
                        <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}>
                        男性
                    </label>

                    <label>
                        <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                        女性
                    </label>

                    <label>
                        <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
                        その他
                    </label>
                </div>

                @error('gender')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <label class="form__label">メールアドレス <span class="form__required">※</span></label>
            <div class="form__input-area">
                <input class="form__input" type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">

                @error('email')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <label class="form__label">電話番号 <span class="form__required">※</span></label>
            <div class="form__input-area">
                <div class="form__tel-inputs">
                    <input class="form__input" type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}" inputmode="numeric" pattern="[0-9]*">
                    <span>-</span>
                    <input class="form__input" type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}" inputmode="numeric" pattern="[0-9]*">
                    <span>-</span>
                    <input class="form__input" type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}" inputmode="numeric" pattern="[0-9]*">
                </div>

                @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                    <p class="form__error">
                        {{ $errors->first('tel1') ?: ($errors->first('tel2') ?: $errors->first('tel3')) }}
                    </p>
                @endif
            </div>
        </div>

        <div class="form__group">
            <label class="form__label">住所 <span class="form__required">※</span></label>
            <div class="form__input-area">
                <input class="form__input" type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">

                @error('address')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <label class="form__label">建物名</label>
            <div class="form__input-area">
                <input class="form__input" type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
            </div>
        </div>

        <div class="form__group">
            <label class="form__label">お問い合わせの種類 <span class="form__required">※</span></label>
            <div class="form__input-area">
                <select class="form__select" name="category_id">
                    <option value="">選択してください</option>

                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>

                @error('category_id')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form__group">
            <label class="form__label">お問い合わせ内容 <span class="form__required">※</span></label>
            <div class="form__input-area">
                <textarea class="form__textarea" name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>

                @error('detail')
                    <p class="form__error">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection