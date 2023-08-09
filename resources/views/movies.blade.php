@extends('layouts.app')

@section('content')
<div class="search">
    <form>
        <div class="row">
            <div class="col">
                <input type="text" class="form-control" placeholder="検索フォーム">
            </div>
            <div class="col">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
                    <label class="form-check-label" for="inlineRadio1">全て</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">公開中</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                    <label class="form-check-label" for="inlineRadio3">公開予定</label>
                </div>
            </div>
            <div class="col">
                <button class="btn btn-primary">検索</button>
            </div>
        </div>
    </form>
</div>



<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">映画タイトル</th>
            <th scope="col">画像URL</th>
            <th scope="col">公開中か</th>
        </tr>
    </thead>
    <tbody>
        @foreach ( $movies as $movie)
        <tr>
            <td>{{ $movie->title}}</td>
            <td>{{ $movie->image_url}}</td>
            
            @if($movie->is_showing==1)
                <td>公開中</td>
            @else
                <td>公開予定</td>
            @endif

        </tr>
        @endforeach
    </tbody>
</table>
@endsection