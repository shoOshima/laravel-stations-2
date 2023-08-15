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
            <th scope="col">予約</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $schedules as $sch)
        <tr>
            <td>{{ date('H:i',strtotime($sch->start_time)) }}</td>
            <td>{{ date('H:i',strtotime($sch->end_time)) }}</td>
            <td>
                <form method="GET" action="{{route('reserv.showsheet',['movie_id'=>$movie->id,'schedule_id'=>$sch->id,'date'=>date('Y-m-d',strtotime($sch->start_time))])}}">
                    <input type="hidden" name="date" value="{{ date('Y-m-d',strtotime($sch->start_time)) }}"/>
                <button type="submit" class="btn btn-success">座席を予約する</button>

                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



@endsection