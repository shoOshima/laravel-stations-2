@extends('layouts.app')

@section('content')
<div class="search">
    <form method="GET" action="movies">
        <div class="row">
            <div class="col">
                <input type="text" name="keyword" class="form-control" placeholder="検索フォーム">
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_showing" value="" checked>
                    <label class="form-check-label" for="inlineRadio1">全て</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_showing" id="1" value="1">
                    <label class="form-check-label" for="inlineRadio2">公開中</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="is_showing" id="0" value="0">
                    <label class="form-check-label" for="inlineRadio3">公開予定</label>
                </div>
            </div>
            <div class="col">
                <button class="btn btn-primary">検索</button>
            </div>
        </div>
    </form>
</div>


{{ $movies->links() }}
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">映画タイトル</th>
            <th scope="col">画像URL</th>
            <th scope="col">公開中か</th>
            <th scope="col">概要</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $movies as $movie)
        <tr>
            <td><a href="{{route('movies.detail',['id'=>$movie->id]);}}">{{ $movie->title}}</a></td>
            <td>{{ $movie->image_url}}</td>
            
            @if($movie->is_showing==1)
                <td>公開中</td>
            @else
                <td>公開予定</td>
            @endif
            <td>{{ $movie->description}}</td>
        </tr>
        @endforeach
    </tbody>
</table>



@endsection