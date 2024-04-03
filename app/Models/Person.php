<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'second_name',
        'first_surname',
        'second_surname',
        'married_surname',
        'document_type',
        'document',
        'birthdate',
        'phone_number',
        'email',
        'gender',
        'civil_status',
        'address',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
