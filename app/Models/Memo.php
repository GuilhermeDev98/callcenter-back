<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'attendance_id',
        'user_id',
    ];

    public function creator(){
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y - H:m',
    ];
}
