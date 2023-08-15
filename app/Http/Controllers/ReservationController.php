<?php

  namespace App\Http\Controllers;

  use App\Models\Movie;
  use App\Models\Genre;
  use App\Models\Schedule;
  use App\Models\Sheet;
  use App\Models\Reservation;

  use Illuminate\Support\Facades\DB;
  
  use Illuminate\Http\Request;
  use App\Http\Requests\MovieRequest;
  use App\Http\Requests\UpmovieRequest;

  use App\Http\Requests\CreateReservationRequest;
  use Illuminate\Support\Facades\Validator;


  class ReservationController extends Controller
  {
    public function index(Request $request){
      $date = $request->date;
      $movie_id = $request->route('movie_id');
      $schedule_id = $request->route('schedule_id');
      $sheets = Sheet::all();
      return view('sheetsReservation',['sheets' => $sheets,'movie_id'=>$movie_id,'sch_id'=>$schedule_id,'date'=>$date]);
    }

    public function create(Request $request){
      $movie_id = $request->route('movie_id');
      $schedule_id = $request->route('schedule_id');
      $date = $request->date;
      $sheet_id = $request->sheetId;
      return view('sheetReservationCreate',
        ['movie_id'=>$movie_id,'sch_id'=>$schedule_id,'date'=>$date,'sheet_id'=>$sheet_id]);
    }

    public function store(CreateReservationRequest $request){
      $data= $request->validated();

      $reserv = Reservation::where([
          ['schedule_id','=', $data['schedule_id']],
          ['sheet_id','=',$data['sheet_id']] 
      ])->first();
      
      $sch= Schedule::where('id',$data['schedule_id'])->with('movie')->first();

      if($reserv){
        
        return redirect()->route('reserv.showsheet',['movie_id'=>$sch->movie->id,'schedule_id'=>$data['schedule_id'],'date'=>$data['date']]);
      }else{
        Reservation::create($request->validated());
        return redirect()
            ->route('movies.detail',['id'=>$sch->movie->id]);
      }
     
    }

    public function destroy(int $id){

      $movie = Movie::where('id',$id)->firstOrFail()->delete();

     if($movie){
      return redirect()->route('movies')->with('message','成功');
     }else{
      return redirect()->route('movies')->with('message','失敗');
     }
    }

  }
