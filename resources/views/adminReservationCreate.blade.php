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

<form action="{{route('adm.reserv.store')}}" method="post">
  @csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">メールアドレス</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">名前</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="予約者名" name="name">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">スケジュールID</label>
    <select name="schedule_id" onchange="outputSelectedValueAndText(this);">
      @foreach($sch as $s)
        <option value="{{$s->id}}">mID:{{$s->movie_id}}_sch:{{$s->id}}_start:{{$s->start_time}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">シートID</label>
    <select name="sheet_id" id="sheetId">
    @for($i = 0; $i < 15; $i++)
      <option value="{{$i+1}}">{{$i+1}}</option>
    @endfor
    </select>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">日付</label>
    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="y-m-d" name="date" value="{{date('Y-m-d')}}">
  </div>

  <button type="submit" class="btn btn-success">席を予約する</button>
</form>

<script>
function outputSelectedValueAndText(obj)
{
    /* 
     * obj は select タグであり、selectedIndex プロパティには
     * 変更後の選択項目のインデックスが格納されています
     */
    var idx = obj.selectedIndex;
    var value = obj.options[idx].value; // 値
    var text  = obj.options[idx].text;  // 表示テキスト
 
    // 値とテキストをコンソールに出力
    console.log('value = ' + value + ', ' + 'text = ' + text+'{{$sch['0']->reservation}}');

    var sheetSelect =document.getElementById("sheetId");
}

</script>

@endsection