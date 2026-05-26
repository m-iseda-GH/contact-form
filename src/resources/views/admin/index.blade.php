@extends('layouts.app')

@section('title', '管理画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header-button')
<form action="/logout" method="post">
    @csrf
    <button class="header__logout-button" type="submit">logout</button>
</form>
@endsection

@section('content')
<div class="admin">
    <h2 class="admin__title">Admin</h2>

    <form id="admin-search-form" class="admin-search" action="/admin" method="get">
        <input
            class="admin-search__input"
            type="text"
            name="keyword"
            placeholder="名前やメールアドレスを入力してください"
            value="{{ request('keyword') }}"
            form="admin-search-form"
        >

        <select class="admin-search__select" name="gender" form="admin-search-form">
            <option value="">性別</option>
            <option value="all" {{ request('gender') === 'all' ? 'selected' : '' }}>全て</option>
            <option value="1" {{ request('gender') === '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') === '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') === '3' ? 'selected' : '' }}>その他</option>
        </select>

        <select class="admin-search__select admin-search__select--category" name="category_id" form="admin-search-form">
            <option value="">お問い合わせの種類</option>

            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
            @endforeach
        </select>

        <input
            class="admin-search__date"
            type="date"
            name="date"
            value="{{ request('date') }}"
            form="admin-search-form"
        >

        <button class="admin-search__button" type="submit" form="admin-search-form">検索</button>
        <a class="admin-search__reset" href="/admin">リセット</a>
    </form>

    <div class="admin__utility">
        <a class="admin__export" href="{{ url('/admin/export?' . http_build_query(request()->query())) }}">
            エクスポート
        </a>

        <div class="admin__pagination admin__pagination--top">
            {{ $contacts->links('vendor.pagination.custom') }}
        </div>
    </div>

    <table class="admin-table">
        <colgroup>
            <col class="admin-table__col-name">
            <col class="admin-table__col-gender">
            <col class="admin-table__col-email">
            <col class="admin-table__col-category">
            <col class="admin-table__col-detail">
        </colgroup>

        <tr class="admin-table__row">
            <th class="admin-table__header">お名前</th>
            <th class="admin-table__header">性別</th>
            <th class="admin-table__header">メールアドレス</th>
            <th class="admin-table__header">お問い合わせの種類</th>
            <th class="admin-table__header"></th>
        </tr>

        @foreach ($contacts as $contact)
            <tr class="admin-table__row">
                <td class="admin-table__text">{{ $contact->last_name }} {{ $contact->first_name }}</td>

                <td class="admin-table__text">
                    @if ($contact->gender == 1)
                        男性
                    @elseif ($contact->gender == 2)
                        女性
                    @else
                        その他
                    @endif
                </td>

                <td class="admin-table__text">{{ $contact->email }}</td>
                <td class="admin-table__text">{{ $contact->category->content }}</td>

                <td class="admin-table__text admin-table__text--button">
                    <label class="admin-table__button" for="modal-toggle-{{ $contact->id }}">詳細</label>
                </td>
            </tr>
        @endforeach
    </table>

    @foreach ($contacts as $contact)
        <input type="checkbox" id="modal-toggle-{{ $contact->id }}" class="modal-toggle">

        <div class="modal">
            <div class="modal__content">
                <label class="modal__close" for="modal-toggle-{{ $contact->id }}">×</label>

                <table class="modal-table">
                    <tr>
                        <th class="modal-table__header">お名前</th>
                        <td class="modal-table__text">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    </tr>

                    <tr>
                        <th class="modal-table__header">性別</th>
                        <td class="modal-table__text">
                            @if ($contact->gender == 1)
                                男性
                            @elseif ($contact->gender == 2)
                                女性
                            @else
                                その他
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="modal-table__header">メールアドレス</th>
                        <td class="modal-table__text">{{ $contact->email }}</td>
                    </tr>

                    <tr>
                        <th class="modal-table__header">電話番号</th>
                        <td class="modal-table__text">{{ $contact->tel }}</td>
                    </tr>

                    <tr>
                        <th class="modal-table__header">住所</th>
                        <td class="modal-table__text">{{ $contact->address }}</td>
                    </tr>

                    <tr>
                        <th class="modal-table__header">建物名</th>
                        <td class="modal-table__text">{{ $contact->building }}</td>
                    </tr>

                    <tr>
                        <th class="modal-table__header">お問い合わせの種類</th>
                        <td class="modal-table__text">{{ $contact->category->content }}</td>
                    </tr>

                    <tr>
                        <th class="modal-table__header">お問い合わせ内容</th>
                        <td class="modal-table__text">{{ $contact->detail }}</td>
                    </tr>
                </table>

                <form class="modal__delete-form" action="/admin/delete/{{ $contact->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="modal__delete-button" type="submit">削除</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection