@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" href="{{route('adm.reserv.create')}}">予約追加</a>
    <table>
        <tr>
            <th>映画作品</th>
            <th>座席</th>
            <th>日時</th>
            <th>名前</th>
            <th>メールアドレス</th>
        </tr>
    @foreach ($reserv as $r)
        <tr>
            <td>{{ $r->schedule['0']->movie_id}}</td>
            <td>{{ $r->sheet_id }}</td>
            <td>{{ $r->date }}</td>
            <td>{{ $r->name }}</td>
            <td>{{ $r->email }}</td>
        </tr>
    @endforeach
    <table>
@endsection