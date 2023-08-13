@extends('layouts.app')

@section('content')

<h2>{{$movie->title}}_上映スケジュール管理</h2>

    <a href="{{ route('admin.sch.create',['id'=>$movie->id]);}}"><h6>上映スケジュール追加</h6></a>
      <table>
        <tr>
          <th>
            上映開始
          </th>
          <th>
            上映終了
          </th>
          <th>
            編集
          </th>
          <th>
            削除
          </th>
        </tr>
        @foreach( $movie->schedules as $sch)
          <tr>
            
            <td>{{ $sch->start_time }}</td>
            <td>{{ $sch->end_time }}</td>
            <td><a href="{{route('admin.sch.edit',['scheduleId' => $sch->id])}}">編集</td>
            <td>
              <form action="{{url('/admin/schedules/'.$sch->id.'/destroy');}}" method="POST">
                @method('DELETE')
                @csrf
                <input type="submit" value="削除" class="btn-dell">
              </form>
            </td>
            
          </tr>
        @endforeach
</table>




@endsection