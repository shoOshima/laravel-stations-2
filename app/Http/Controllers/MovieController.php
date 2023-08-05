<?php

  namespace App\Http\Controllers;

  use App\Models\Movie;
  use App\Http\Requests\MovieRequest;
  use Illuminate\Support\Facades\Validator;

  class MovieController extends Controller
  {
    public function index(){
      $movies = Movie::all();
      return view('movies',['movies' => $movies]);
    }

    public function admin_movies(){
      $movies = Movie::all();
      return view('adminMovies',['movies' => $movies]);
    }

    public function create(){
      return view('createMovies');
    }

    public function store(MovieRequest $request){

    $movie = Movie::create($request->validated());

      if($movie){
        return redirect()
          ->route('movies');
      }else{
        return view('createMovies')
          ->with('error','失敗');

      }
      
      
    }

  }
