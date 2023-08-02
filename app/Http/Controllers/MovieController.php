<?php

  namespace App\Http\Controllers;

  use App\Models\Movie;

  class MovieController extends Controller
  {
    public function index(){
      $movies = Movie::all();
      return response($movies);
    //  return view('movies',['movies' => $movies]);
    }

    public function admin_movies(){
      $movies = Movie::all();
      return view('adminMovies',['movies' => $movies]);
    }
  }
