<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Models\Screen;
use Illuminate\Foundation\Http\FormRequest;

class CreateScheduleRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'movie_id' => ['required'],
            'start_time_date' => ['required', 'date_format:Y-m-d', 'before_or_equal:end_time_date'],
            'start_time_time' => ['required', 'date_format:H:i'],
            'end_time_date' => ['required', 'date_format:Y-m-d', 'after_or_equal:start_time_date'],
            'end_time_time' => ['required', 'date_format:H:i'],
            'screen' => ['required']
        ];
    }

    public function withValidator($validator)
    {
        
        $validator->after(function ($validator) {
            if ($validator->errors()->any()) {
                return;
              }
            $start = new Carbon($this->start_time_date." ".$this->start_time_time);
            $end =  new Carbon($this->end_time_date." ".$this->end_time_time);
            $ts = $this->start_time_date." ".$this->start_time_time;
            $te =$this->end_time_date." ".$this->end_time_time;
            $screenFlg=false;
            if($start>=$end){
                $validator->errors()->add('start_time_time', '開始時刻が終了より後');
                $validator->errors()->add('end_time_time', '開始時刻が終了より後');
            }
            if($start->addMinutes(5)>=$end){
                $validator->errors()->add('start_time_time', '開始時刻が終了時刻５分以内');
                $validator->errors()->add('end_time_time', '開始時刻が終了時刻５分以内');
            }
            
            $screenSch = Screen::where('screen','=',$this->screen)
                        ->where('start_time','>=',$this->start_time_date." 00:00")
                        ->where('end_time','<=',$this->end_time_date." 23:59")->get();
            foreach($screenSch as $screen){
                $ss = $screen->start_time;
                $se = $screen->end_time;
                //開始時間がすでに予約済の範囲内ではないか
                if($ts>=$ss && $ts<=$se){
                    $screenFlg=true;
                    break;
                }
                //終了時間がすでに予約済の範囲内ではないか
                if($te>=$ss && $te<=$se){
                    $screenFlg=true;
                    break;
                }
                //範囲内に予約済がないか
                if($ts<=$ss && $te>=$se){
                    $screenFlg=true;
                    break;
                }
            }
            if($screenFlg){
                $validator->errors()->add('screen', 'すでに使用予定のスクリーン');
            }

        });
    }

}
