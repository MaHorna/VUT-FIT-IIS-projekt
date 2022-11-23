<?php

namespace App\Models;

use App\Models\User;
use App\Models\Teamuser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    // Relationship to User
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to TeamUser
    public function teamUser(){
        return $this->hasMany(Teamuser::class, 'team_id');
    }
}
