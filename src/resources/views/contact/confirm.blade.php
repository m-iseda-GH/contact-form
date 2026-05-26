@extends('layouts.app')

@section('title', 'お問い合わせ確認')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm">
    <h2 class="confirm__title">Confirm</h2>

    <form class="confirm__form" action="/thanks" method="post">
        @csrf

        <table class="confirm-table">
            <tr>
                <th class="confirm-table__header">お名前</th>
                <td class="confirm-table__text">{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
            </tr>

            <tr>
                <th class="confirm-table__header">性別</th>
                <td class="confirm-table__text">
                    @if ($contact['gender'] == 1)
                        男性
                    @elseif ($contact['gender'] == 2)
                        女性
                    @else
                        その他
                    @endif
                </td>
            </tr>

            <tr>
                <th class="confirm-table__header">メールアドレス</th>
                <td class="confirm-table__text">{{ $contact['email'] }}</td>
            </tr>

            <tr>
                <th class="confirm-table__header">電話番号</th>
                <td class="confirm-table__text">{{ $contact['tel'] }}</td>
            </tr>

            <tr>
                <th class="confirm-table__header">住所</th>
                <td class="confirm-table__text">{{ $contact['address'] }}</td>
            </tr>

            <tr>
                <th class="confirm-table__header">建物名</th>
                <td class="confirm-table__text">{{ $contact['building'] }}</td>
            </tr>

            <tr>
                <th class="confirm-table__header">お問い合わせの種類</th>
                <td class="confirm-table__text">{{ $category->content }}</td>
            </tr>

            <tr>
                <th class="confirm-table__header">お問い合わせ内容</th>
                <td class="confirm-table__text">{{ $contact['detail'] }}</td>
            </tr>
        </table>

        @foreach ($contact as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach

        <div class="confirm__button-area">
            <button class="confirm__button-submit" type="submit">送信</button>
            <button class="confirm__button-correction" type="submit" formaction="/back" formmethod="post">修正</button>
        </div>
    </form>
</div>
@endsection