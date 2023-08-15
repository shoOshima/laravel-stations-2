@extends('layouts.app')

@section('content')
@if ($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-success">
        {{$error}}
    </div>
    @endforeach
@endif

<h1>座席予約フォーム</h1>
<p>映画ID:{{ $movie_id }}</p>
<p>上映スケジュール:{{ $sch_id }}</p>
<p>座席:{{ $sheet_id }}</p>
<p>日付:{{ $date }}</p>

<form action="{{route('reserv.store')}}" method="post">
  @csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">メールアドレス</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">名前</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="予約者名" name="name">
  </div>
  <input type="hidden" name="schedule_id" value="{{ $sch_id }}"/>
  <input type="hidden" name="sheet_id" value="{{ $sheet_id }}"/>
  <input type="hidden" name="date" value="{{ $date }}"/>

  <button type="submit" class="btn btn-success">席を予約する</button>
</form>

@endsection