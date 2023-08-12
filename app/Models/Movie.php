<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = ['created_at', 'updated_at'];
    use HasFactory;

    public function genre(){
        return $this->belongsTo(Genre::class,'genre_id','id');
    }

    public function schedules(){
        return $this->hasMany(Schedule::class);
    }

}
