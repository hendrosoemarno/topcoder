<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'participant_id',
        'bootcamp_package_id',
        'amount',
        'payment_method',
        'status',
        'payment_url',
        'reference'
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }

    public function package()
    {
        return $this->belongsTo(BootcampPackage::class, 'bootcamp_package_id');
    }
}
