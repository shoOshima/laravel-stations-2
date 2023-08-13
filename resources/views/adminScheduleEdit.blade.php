@extends('layouts.app')

@section('content')

<h2>{{$sch->movie->title}}_上映スケジュール編集</h2>
<form action="{{url('/admin/schedules/'.$sch->id.'/update');}}" method="POST">
@method('PATCH')  
@csrf
  <input type="hidden" name="movie_id" value="{{$sch->movie->id}}"/>
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