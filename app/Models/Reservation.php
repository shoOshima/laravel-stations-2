<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $attributes = [
        'is_canceled' => false,
    ];
    protected $guarded = ['created_at', 'updated_at'];

    public function schedule(){
        return $this->hasMany(Schedule::class,'id','schedule_id');
    }
}
