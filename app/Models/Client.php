<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Client extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'registration',
        'profile_photo',
        'full_name',
        'full_mother_name',
        'full_father_name',
        'cpf',
        'rg',
        'address',
        "number_of_house",
        'district',
        'city',
        'state',
        'cep',
        'contact_email',
        'contact_phone_1',
        'contact_name_1',
        'contact_phone_2',
        'contact_name_2',
        'auxiliary_information',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function logs() {
        return $this->HasMany('App\Models\Logs', 'user_id', 'user_id');
    }

    public function attendances() {
        return $this->HasMany('App\Models\Attendance', 'client_id', 'user_id');
    }

    //protected $hidden = ['id'];
}
