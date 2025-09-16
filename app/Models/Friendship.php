<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Friendship extends Model
{
    // Habilitar asignación masiva para los campos usados en firstOrCreate
    protected $fillable = [
        'user_id',
        'friend_id',
        'status',
    ];

    // Definir las relaciones si es necesario
    public function friend()
    {
        return $this->belongsTo(User::class, 'friend_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
