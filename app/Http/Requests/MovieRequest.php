<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class MovieRequest extends FormRequest
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

     public function validationData()
     {
         $data = $this->all();
            // dd($this->boolean('is_showing[0]'));
         // 前処理
         if (isset($data['is_showing'])){
            $a = $data['is_showing'];
            if($a[0]=="on"){
                $data['is_showing'] =(boolean)true;
            }else{
                $data['is_showing'] =0;
            }

            
        }

         return $data;
     }

    public function rules()
    {
        return [
            'title' => ['required','unique:movies,title'],
            'image_url' => ['required', 'url'],
            'published_year' => ['required'],
            'is_showing' => ['required'],
            'description' => ['required']

        ];
    }

    public function messages(){
        return [
            'title' => 'Etitle',
            'image_url' => 'Eurl',
            'published_year' => 'Epub',
            'is_showing' => 'Eshow',
            'description' => 'Edis'
        ];
    }

}
