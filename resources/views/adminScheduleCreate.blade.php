@extends('layouts.app')

@section('content')
@if ($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-success">
        {{$error}}
    </div>
    @endforeach
@endif
<h2>{{$movie->title}}_上映スケジュール登録</h2>
<form action="{{url('/admin/movies/'.$movie->id.'/schedules/store');}}" method="POST">
  
@csrf
  <input type="hidden" name="movie_id" value="{{$movie->id}}"/>
  <div class="row">
      <div class="col-5">
        <label for="inputEmail4">開始日付</label>
        <input type="date" class="form-control" id="inputEmail4" name="start_time_date">
      </div>
      <div class="col-5">
        <label for="inputEmail4">開始時間</label>
        <input type="time" class="form-control" id="inputEmail4" name="start_time_time">
      </div>
  </div>
  <div class="row">
      <div class="col-5">
        <label for="inputEmail4">終了日付</label>
        <input type="date" class="form-control" id="inputEmail4" name="end_time_date">
      </div>
      <div class="col-5">
        <label for="inputEmail4">終了時間</label>
        <input type="time" class="form-control" id="inputEmail4" name="end_time_time">
      </div>
  </div>
  <button type="submit" class="btn btn-primary">登録</buton>
</form>

@endsection