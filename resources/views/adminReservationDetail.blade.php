@extends('layouts.app')

@section('content')
@if ($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-success">
        {{$error}}
    </div>
    @endforeach
@endif

<h1>予約編集フォーム</h1>
<form action="{{route('adm.reserv.destory',['id'=>$reserv->id]);}}" method="POST">
            @method('DELETE')
            @csrf
            <input type="submit" value="削除" class="btn-dell">
</form>

<form action="{{route('adm.reserv.update',['id'=>$reserv->id])}}" method="post">
  @method('PATCH')
  @csrf
  <div class="form-group">
    <label for="exampleFormControlInput1">映画作品ID</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="movie_id" value="{{ $reserv->schedule[0]->movie_id }}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">メールアドレス</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email" value="{{ $reserv->email }}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">名前</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="予約者名" name="name" value="{{ $reserv->name }}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">スケジュールID</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="予約者名" name="schedule_id" value="{{ $reserv->schedule_id }}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">シートID</label>
    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="予約者名" name="sheet_id" value="{{ $reserv->sheet_id }}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">日付</label>
    <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="y-m-d" name="date" value="{{ $reserv->date }}">
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
    console.log('value = ' + value + ', ' + 'text = ' + text+);

    var sheetSelect =document.getElementById("sheetId");
}

</script>

@endsection