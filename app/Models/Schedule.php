<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['movie_id','start_time','end_time'];
    protected $dates = ['start_time','end_time'];
    use HasFactory;

    public function movie()
    {
        return $this->belongsTo(Movie::class,'movie_id','id');
    }

    public function reservation()
    {
        return $this->hasMany(Reservation::class);
    }
}
