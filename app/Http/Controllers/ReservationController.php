<?php

  namespace App\Http\Controllers;

  use App\Models\Movie;
  use App\Models\Genre;
  use App\Models\Schedule;
  use App\Models\Sheet;
  use App\Models\Reservation;
  use Carbon\CarbonImmutable;
  use Carbon\Carbon;

  use Illuminate\Support\Facades\DB;
  
  use Illuminate\Http\Request;
  use App\Http\Requests\MovieRequest;
  use App\Http\Requests\UpmovieRequest;

  use App\Http\Requests\CreateReservationRequest;

  use App\Http\Requests\CreateAdminReservationRequest;
  use App\Http\Requests\UpAdminReservationRequest;

  use Illuminate\Support\Facades\Validator;


  class ReservationController extends Controller
  {
    public function index(Request $request){
      $date = $request->date;
      if(!$date){
        abort(400);
      }
      
      $movie_id = $request->route('movie_id');
      $schedule_id = $request->route('schedule_id');
      $sheets = Sheet::with(['reservation'=>function($q)use($schedule_id){
        $q->where('schedule_id','=',$schedule_id);
      }])->get();
      return view('sheetsReservation',['sheets' => $sheets,'movie_id'=>$movie_id,'sch_id'=>$schedule_id,'date'=>$date]);
    }

    public function create(Request $request){
      $movie_id = $request->route('movie_id');
      $schedule_id = $request->route('schedule_id');
      $date = $request->date;
      $sheet_id = $request->sheetId;
      if(!$date || !$sheet_id){
        abort(400);
      }

      $reserv = Reservation::where([
        ['schedule_id','=',$schedule_id],
        ['sheet_id','=',$sheet_id] 
      ])->first();

      if($reserv){
        abort(400);
      }

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

    public function admIndex(){

      $re = Reservation::with('schedule')->get();
      $c=Reservation::count();
      $reserv = Reservation::whereHas('schedule',function($q){
        $q->whereDate('end_time','>=',Carbon::now());
      })->get();
      // new CarbonImmutable('2050-01-01 00:00:00')
      // date("Y-m-d H:i:s")
      return view('adminReservation',['reserv'=>$reserv,'c'=>$c]);
    }

    public function admCreate(){
      // $sch = Schedule::with('reservation')->get();
      return view('adminReservationCreate'); //,['sch'=>$sch]);
    }

    public function admStore(CreateAdminReservationRequest $request){
      $data= $request->validated();

      // $reserv = Reservation::where([
      //     ['schedule_id','=', $data['schedule_id']],
      //     ['sheet_id','=',$data['sheet_id']] 
      // ])->first();
      
      // if($reserv){  
      //   return redirect()->route('adm.reserv.index');
      // }else{
        // Reservation::create($request->validated());
        Reservation::create([
          'email' => $data['email'],
          'name' => $data['name'],
          'schedule_id' => $data['schedule_id'],
          'sheet_id' => $data['sheet_id'],
          'date' => $data['date'],
        ]);
        return redirect()->route('adm.reserv.index');
      // }
    }

    public function admDetail(Request $request){
      $reserv_id = $request->route('id');
      $reserv=Reservation::where('id',$reserv_id)->with('schedule')->first();

      return view('adminReservationDetail',['reserv'=>$reserv]);
    }

    public function admUpdate(UpAdminReservationRequest $request){
      $data= $request->validated();
      $reserv_id = $request->route('id');

      //空席チェック
      $reservCheck = Reservation::where([
        ['id','<>',$reserv_id],
        ['schedule_id','=', $data['schedule_id']],
        ['sheet_id','=',$data['sheet_id']] 
      ])->first();

      if($reservCheck){
        return response("予約あり");
      }else{

        $reserv = Reservation::where('id',$reserv_id)
          ->first()->update([
            'email' => $data['email'],
            'name' => $data['name'],
            'schedule_id' => $data['schedule_id'],
            'sheet_id' => $data['sheet_id'],
            'date' => $data['date'],
          ]);
          return redirect()->route('adm.reserv.index');
      }
    }

    public function admDestory(int $reserv_id){
      $reserv = Reservation::where('id',$reserv_id)
        ->firstOrFail()->delete();

      if($reserv){
        return redirect()->route('adm.reserv.index')->with('message','成功');
      }else{
        return redirect()->route('adm.reserv.index')->with('message','失敗');
      }
    }


  }
