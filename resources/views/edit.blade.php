<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Practice</title>
</head>
<body>
@if ($errors->any())
    @foreach($errors->all() as $error)
    <div class="alert alert-success">
        {{$error}}
    </div>
    @endforeach
@endif
  <h2>フォーム</h2>
  <form action="{{route('movies.update',['id'=>$movie->id])}}" method="POST">
  @method('PATCH')
      映画タイトル:<br>
      <input name="title" value="{{ $movie->title }}"/>
      <br>
      ジャンル:<br/>
      <input name="genre" value="{{ old('genre') }}"/>
      <br/>
      <br>
      画像URL:<br/>
      <input name="image_url" value="{{ $movie->image_url }}"/>
      <br/>
      公開年:<br/>
      <input name="published_year" value="{{ $movie->published_year }}"/>
      <br/>
      公開中かどうか:<br/>
      @if($movie->is_showing)
        <input name="is_showing[]" type="checkbox" checked/>
      @else
      <input name="is_showing[]" type="checkbox"/>
      @endif

      <br/>
      概要:<br>
      <textarea name="description" rows="4" cols="40" >{{ $movie->description }}</textarea>
      <br>
      <button class="btn btn-success"> 送信 </button>
      {{ csrf_field() }}
  </form>
</body>
</html>