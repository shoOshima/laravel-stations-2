<?php

  namespace App\Http\Controllers;

  use Illuminate\Support\Facades\DB;
  use App\Models\Sheet;
  
  use Illuminate\Http\Request;

  class SheetController extends Controller
  {
    public function index(){
      $sheets = Sheet::all();
      return view('sheets',['sheets' => $sheets]);
    }

  }
