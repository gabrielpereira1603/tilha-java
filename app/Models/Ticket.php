<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['value', 'buyer', 'belongs_to', 'type', 'car_plate'];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer');
    }

    public function belongsToUser()
    {
        return $this->belongsTo(User::class, 'belongs_to');
    }
}
