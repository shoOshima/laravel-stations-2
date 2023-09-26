<?php

  namespace App\Http\Controllers;

  use Illuminate\Support\Facades\DB;
  use App\Models\Schedule;
  use App\Models\Movie;
  use App\Models\Screen;
  use App\Http\Requests\CreateScheduleRequest;

  use Carbon\Carbon;
  
  use Illuminate\Http\Request;

  class ScheduleController extends Controller
  {
    public function index(){
      $movies = Movie::with('schedules')->whereHas('schedules',function($q){
        $q->whereExists(function($q){
          return $q;
        });
      })->get();
      return view('schedules',['movies' => $movies]);
    }

    public function schedulesForMovie(int $id){
      $movie = Movie::where('id',$id)->with('genre')->with('schedules')->first();
      return view('adminMovieSchedules',['movie'=>$movie]);
    }

    public function create(int $id){
      $movie = Movie::where('id',$id)->first();
      return view('adminScheduleCreate',['movie'=>$movie]);
    }

    public function store(CreateScheduleRequest $request){
      $data = $request->validated();

      $schedule = DB::transaction(function() use($request){
        $data = $request->validated();
        $start = $data['start_time_date']." ".$data['start_time_time'];
        $end = $data['end_time_date']." ".$data['end_time_time'];
        $schedule = Schedule::create([
          'movie_id' => $data['movie_id'],
          'start_time' => $start,
          'end_time' => $end,
        ]);
        Screen::create([
          'screen' => $data['screen'],
          'schedule_id' => $schedule->id,
          'start_time' => $start,
          'end_time' => $end
        ]);
        return $schedule;
      });


      if($schedule){
        return redirect()->route('movies');
      }else{
        return redirect()->route('admin.sch.create',['id'=>$data['movie_id']]);
      }
    }

    public function edit(int $id){
      $schedule = Schedule::where('id',$id)->with('movie')->first();
      return view('adminScheduleEdit',['sch' => $schedule]);
    }

    public function update(int $id,CreateScheduleRequest $request){
      $data = $request->validated();
      $schedule = Schedule::where('id',$id)->first()
        ->update([
          'movie_id' => $data['movie_id'],
          'start_time' => $data['start_time_date']." ".$data['start_time_time'],
          'end_time' => $data['end_time_date']." ".$data['end_time_time'],
        ]);

        if($schedule){
          return redirect()
            ->route('movies');
        }else{
          return redirect()->route('admin.sch.detail',['id'=>$data['movie_id']]);
        }
    }

    public function destroy(int $id){
      $sch = Schedule::where('id',$id)->firstOrFail()->delete();

      if($sch){
       return redirect()->route('movies')->with('message','成功');
      }else{
       return redirect()->route('movies')->with('message','失敗');
      }
     }
    
     

  }