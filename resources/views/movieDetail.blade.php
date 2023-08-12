@extends('layouts.app')

@section('content')

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">映画タイトル</th>
            <th scope="col">画像URL</th>
            <th>公開年</th>
            <th scope="col">公開中か</th>
            <th scope="col">概要</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $movie->title}}</td>
            <td><img src="{{ $movie->image_url}}" /></td>
            <td>{{ $movie->published_year}}</td>
            @if($movie->is_showing==1)
                <td>公開中</td>
            @else
                <td>公開予定</td>
            @endif
            <td>{{ $movie->description}}</td>
        </tr>
    </tbody>
</table>

<h1>上映スケジュール</h1>
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">上映開始時刻</th>
            <th scope="col">上映終了時刻</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $schedules as $sch)
        <tr>
            <td>{{ $sch->start_time }}</td>
            <td>{{ date('H:i',strtotime($sch->start_time)) }}</td>
            <td>{{ date('H:i',strtotime($sch->end_time)) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>



@endsection