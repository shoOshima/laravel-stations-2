<?php

  namespace App\Http\Controllers;

  use App\Practice;

  class MovieController extends Controller
  {
    public function index(){
      $practice = Practice::all();
      return view('getPractice',['practices' => $practice]);
    }
  }
