<?php

  namespace App\Http\Controllers;

  use App\Models\Movie;
  use App\Models\Genre;
  use App\Models\Schedule;

  use Illuminate\Support\Facades\DB;
  
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

    public function detail(int $id){
      $movie = Movie::where('id',$id)->with('genre')->first();
      $schedules = Schedule::where('movie_id',$movie->id)->orderBy('start_time', 'asc')->get();
      return view ('movieDetail',['movie'=>$movie,'schedules'=>$schedules]);
    }

    public function admin_movies(){
      $movies = Movie::all();
      return view('adminMovies',['movies' => $movies]);
    }

    // public function admin_movie_detail(int $id){

    // }

    public function create(){
      return view('createMovies');
    }

    public function edit(int $id){
      $movie = Movie::where('id',$id)->with('genre')->first();

      return view('edit',['movie' => $movie]);
    }

    public function update(int $id,UpmovieRequest $request){

      $movie = DB::transaction(function() use($request,$id){
        $data = $request->validated();
        $genru = Genre::firstOrCreate(['name' => $data['genre']]);
        $movie = Movie::where('id',$id)->first()->update([
                                'title' => $data['title'],
                                'image_url' => $data['image_url'],
                                'published_year' => $data['published_year'],
                                'is_showing' => $data['is_showing'],
                                'description' => $data['description'],
                                'genre_id' => $genru->id
        ]);
        return $movie;
      });



        if($movie){
          return redirect()
            ->route('movies');
        }else{
          return view('createMovies')
            ->with('error','失敗');
        }
    }

    public function store(MovieRequest $request){

        
      $movie = DB::transaction(function() use($request){
        $data = $request->validated();
        $genru = Genre::firstOrCreate(['name' => $data['genre']]);
        $movie = Movie::create([
                                'title' => $data['title'],
                                'image_url' => $data['image_url'],
                                'published_year' => $data['published_year'],
                                'is_showing' => $data['is_showing'],
                                'description' => $data['description'],
                                'genre_id' => $genru->id
        ]);
        return $movie;
      });

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
