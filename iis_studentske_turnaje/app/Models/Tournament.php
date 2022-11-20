<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'game', 'start_date', 'prize', 'num_participants', 'teams_allowed', 'description'];

    public function scopeFilter($query, array $filters){
        if ($filters['search'] ?? false) {
            $query->where('name', 'like', '%'. request('search') . '%')
                ->orWhere('game', 'like', '%'. request('search') . '%')
                ->orWhere('status', 'like', '%'. request('search') . '%');
        }
    }
}
