<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Laravel\Scout\Searchable;


class Attendance extends Model
{
    use HasFactory, Searchable;


    protected $fillable = [
        'protocol',
        'classification',
        'input_channel',
        'status',
        'forwarding',
        'return_channel',
        'return_phone',
        'contact_name',
        'summary',
        'memo',
        'client_id',
        'creator_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y - H:m',
    ];

    public function creator(){
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }
}
