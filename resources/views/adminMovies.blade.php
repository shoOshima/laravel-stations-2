<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
    <title>Practice</title>
</head>
<body>
@if (session('message'))
            <div class="flash_message">
                {{ session('message') }}
            </div>
        @endif
    <table>
      <thead>
        <th>ID</th>
        <th>映画タイトル</th>
        <th>画像URL</th>
        <th>公開年</th>
        <th>上映中か</th>
        <th>概要</th>
        <th>登録日時</th>
        <th>更新日時</th>
        <th>編集</th>
        <th>削除</th>
      </thead>
      <tbody>
        @foreach ( $movies as $movie)
        <tr>
          <td><a href="{{route('admin.movie',['id'=>$movie->id]);}}">{{ $movie->id}}</a></td>
          <td>{{ $movie->title}}</td>
          <td>{{ $movie->image_url}}</td>
          <td>{{ $movie->published_year}}</td>
          @if($movie->is_showing)
          <td>上映中</td>
          @else
          <td>上映予定</td>
          @endif
          <td>{{ $movie->description}}</td>
          <td>{{ $movie->created_at	}}</td>
          <td>{{ $movie->updated_at}}</td>
          <td><a type="button" href="{{route('movies.edit',['id'=>$movie->id]);}}">編集</a></td>
          <td>
            <form action="{{url('/admin/movies/'.$movie->id.'/destroy');}}" method="POST">
            @method('DELETE')
            @csrf
            <input type="submit" value="削除" class="btn-dell">
</form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" ></script>
<script type="text/javascript">
      $(function(){
      $(".btn-dell").click(function(){
      if(confirm("本当に削除しますか？")){
      //そのままsubmit（削除）
      }else{
      //cancel
      return ; 
      }
      });
      });
  </script>

</body>
</html>