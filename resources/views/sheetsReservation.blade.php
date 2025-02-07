@extends('layouts.app')

@section('content')


<h1>座席配置</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th colspan="5">スクリーン</th>
        </tr>
    </thead>
    <tbody>
        {{ $r = "0"}}
        @foreach ( $sheets as $sheet)
          @if($r != $sheet->row)
            {{ $r = $sheet->row }}
            <tr>
          @endif

          @if($sheet->reservation->isEmpty())
            <td><a href="{{route('reserv.create',['movie_id'=>$movie_id,'schedule_id'=>$sch_id,'date'=>$date,'sheetId'=>$sheet->id])}}">{{ $sheet->row}}-{{ $sheet->column}}</a></td>
          @else
            <td class="table-dark">{{ $sheet->row}}-{{ $sheet->column}}</td>
          @endif

          @if( $sheet->column ==5)
            </tr>
          @endif
        @endforeach
    </tbody>
</table>


@endsection