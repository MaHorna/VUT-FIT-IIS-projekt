<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Team;
use App\Models\Teamuser;
use App\Models\Tournament;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'logo',
        'won_games',
        'lost_games',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query, array $filters){
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%'. request('search') . '%');
        }
    }

    // Relationship to Team
    public function team(){
        return $this->hasMany(Team::class, 'user_id');
    }

    // Relationship to Team_User
    public function teamUser(){
        return $this->hasMany(Teamuser::class, 'user_id');
    }

    // Relationship to Tournament
    public function tournament(){
        return $this->hasMany(Tournament::class, 'user_id');
    }

    // Relationship to Contestant
    public function contestant(){
        return $this->hasMany(Contestant::class, 'user_id');
    }
}
