<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpAdminReservationRequest extends FormRequest
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
     *     'date' => ['required', 'date_format:Y-m-d'],
     * @return array
     */
    public function rules()
    {
        return [
            'movie_id' =>['required'],
            'schedule_id' => ['required',Rule::unique('reservations')->where('sheet_id',$this->sheet_id)->ignore($this->id)],
            'sheet_id' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email:strict,dns'],
        
        ];
    }
}
