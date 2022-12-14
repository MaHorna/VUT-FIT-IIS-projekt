<?php

namespace App\Models;

use App\Models\Team;
use App\Models\User;
use App\Models\Contestant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teamuser extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'user_id'];

    // Relationship to User
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to Team
    public function team(){
        return $this->belongsTo(Team::class, 'team_id');
    }

    // Relationship to Contestant
    public function contestant(){
        return $this->hasMany(Contestant::class, 'teamuser_id');
    }
}
