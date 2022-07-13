<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Logs extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        "user_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:m',
    ];
}
