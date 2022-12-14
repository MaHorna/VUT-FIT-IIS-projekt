<?php

namespace App\Models;

use App\Models\User;
use App\Models\Contest;
use App\Models\Contestant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'game', 
        'start_date', 
        'prize', 
        'num_participants', 
        'teams_allowed', 
        'description', 
        'logo', 
        'user_id',
        'status',];

    public function scopeFilter($query, array $filters){
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%'. request('search') . '%')
                ->orWhere('game', 'like', '%'. request('search') . '%')
                ->orWhere('status', 'like', '%'. request('search') . '%');
        }
    }

    // Relationship to User
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to Contest
    public function contest(){
        return $this->hasMany(Contest::class, 'tournament_id');
    }

    // Relationship to Contestant
    public function contestant(){
        return $this->hasMany(Contestant::class, 'tournament_id');
    }
}
