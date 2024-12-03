<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'cpf',
        'password',
        'customer'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function ticketsOwned()
    {
        return $this->hasMany(Ticket::class, 'belongs_to');
    }


    public function ticketsBought()
    {
        return $this->hasMany(Ticket::class, 'buyer_id'); // Relacionamento de um para muitos com a tabela tickets
    }
    public function shirts()
    {
        return $this->hasMany(Shirt::class, 'user_id');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'buyer_id');
    }
}
