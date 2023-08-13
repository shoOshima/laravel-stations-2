@extends('layouts.app')

@section('content')



  @foreach ( $movies as $movie)
    <h2>{{ $movie->id}}{{$movie->title}}</h2>
    <h6>上映スケジュール</h6>
      <table>
        <tr>
          <th>
            上映開始
          </th>
          <th>
            上映終了
          </th>
        </tr>
        @foreach( $movie->schedules as $sch)
          <tr>
            
            <td><a href="{{route('admin.sch.detail',['id'=>$movie->id]);}}">{{ $sch->start_time }}</a></td>
            <td>{{ $sch->end_time }}_{{$sch->movie_id}}</td>
            
          </tr>
        @endforeach
</table>

  @endforeach



@endsection