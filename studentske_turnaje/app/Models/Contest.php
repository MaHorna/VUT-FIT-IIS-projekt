<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'tournament_id', 
        'contestant1_id', 
        'contestant2_id', 
        'contest_child_id',
        'date', 
        'score1', 
        'score2', 
        'round',];

    // Relationship to Tournament
    public function tournament(){
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    // Relationship to Contest
    public function contest1(){
        return $this->belongsTo(Contest::class, 'contestant1_id');
    }

    public function contest2(){
        return $this->belongsTo(Contest::class, 'contestant2_id');
    }

    // Relationship to Contestant Parent child //NOT SURE
    public function parent(){
        return $this->belongsTo(Contest::class, 'contest_child_id');
    }

    public function child(){
        return $this->hasMany(Contest::class, 'contest_child_id');
    }

    public function parent_rec(){
        return $this->parent()->with('parent_rec');
    }

    public function child_rec(){
        return $this->child()->with('child_rec');
    }
}
