<?php

namespace App\Models;

use App\Models\User;
use App\Models\Contest;
use App\Models\Teamuser;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contestant extends Model
{
    use HasFactory;

    // Relationship to User
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to Teamuser
    public function teamuser(){
        return $this->belongsTo(Teamuser::class, 'teamuser_id');
    }

    // Relationship to Tournament
    public function tournament(){
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    // Relationship to Contest
    public function contest1(){
        return $this->hasMany(Contest::class, 'contestant1_id');
    }

    public function contest2(){
        return $this->hasMany(Contest::class, 'contestant2_id');
    }
}
