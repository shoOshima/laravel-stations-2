@extends('layouts.app')

@section('content')

<h1>座席配置</h1>
<table class="table table-hover">
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
                <td>{{ $sheet->row}}-{{ $sheet->column}}</td>
          @else
            <td>{{ $sheet->row}}-{{ $sheet->column}}</td>
          @endif
          @if( $sheet->column ==5)
            </tr>
          @endif
        @endforeach
    </tbody>
</table>


@endsection