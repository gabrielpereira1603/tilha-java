<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['value', 'buyer_id', 'belongs_to', 'purchase_id', 'type', 'car_plate', 'cpf'];

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function belongsToUser()
    {
        return $this->belongsTo(User::class, 'belongs_to');
    }

    public function shirts()
    {
        return $this->hasMany(Shirt::class, 'ticket_id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function scopeAvailableForUser($query, $userId)
    {
        return $query->where('belongs_to', $userId)
            ->whereIn('type', ['Motorista', 'Passageiro']);
    }
}
