<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Participant extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'whatsapp',
        'gender',
        'birth_date',
        'address',
        'city',
        'province',
        'postal_code',
        'status',
        'school',
        'school_class',
        'major',
        'campus',
        'study_program',
        'semester',
        'occupation',
        'company',
        'programming_experience',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'birth_date' => 'date',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
