<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', "icon", "color", "supervisor_id"
    ];

    public function supervisor(){
        return $this->belongsTo('App\Models\User', 'supervisor_id');
    }

    public function employees(){
        return $this->belongsToMany('App\Models\User', 'team_user');
    }
}
