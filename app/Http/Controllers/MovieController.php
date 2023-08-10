<?php

  namespace App\Http\Controllers;

  use App\Models\Movie;
  use Illuminate\Http\Request;
  use App\Http\Requests\MovieRequest;
  use App\Http\Requests\UpmovieRequest;
  use Illuminate\Support\Facades\Validator;

  class MovieController extends Controller
  {
    public function index(Request $request){
      $keyword = $request->keyword;
      $is_showing = $request->is_showing;
      $flg_search=false;
      $query = Movie::query();

      if(!empty($keyword)){
        $query->where('title','LIKE',"%{$keyword}%");
        $query->orWhere('description','LIKE',"%{$keyword}%");
        $flg_search=True;
      }

      if($is_showing != null){
        $query->where('is_showing','=',$is_showing);
        $flg_search=True;
      }

      if($flg_search){
        $movies = $query->paginate(20);
      }else{
        $movies = Movie::paginate(20);
      }
      
      return view('movies',['movies' => $movies]);
    }

    public function admin_movies(){
      $movies = Movie::all();
      return view('adminMovies',['movies' => $movies]);
    }

    public function create(){
      return view('createMovies');
    }

    public function edit(int $id){
      $movie = Movie::where('id',$id)->first();
      return view('edit',['movie' => $movie]);
    }

    public function update(int $id,UpmovieRequest $request){

      $movie = Movie::where('id',$id)->first()->update($request->validated());
   //   $movie = $m->update($request->validated());
        if($movie){
          return redirect()
            ->route('movies');
        }else{
          return view('createMovies')
            ->with('error','失敗');
        }
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

    public function destroy(int $id){

      $movie = Movie::where('id',$id)->firstOrFail()->delete();
   //   $movie = $m->update($request->validated());
     if($movie){
      return redirect()->route('movies')->with('message','成功');
     }else{
      return redirect()->route('movies')->with('message','失敗');
     }
    }

  }
