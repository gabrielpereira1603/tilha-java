<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'total_value',
        'purchase_date',
        'qr_code',
        'pix_expiration',
        'key_aleatory',
        'invoiceUrl'
    ];


    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'purchase_id');
    }


    public function shirts()
    {
        return $this->hasManyThrough(
            Shirt::class,
            Ticket::class,
            'purchase_id',
            'ticket_id',
            'id',
            'id'
        );
    }
}
