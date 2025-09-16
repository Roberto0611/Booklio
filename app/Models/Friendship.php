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

    // Si tu tabla no tiene created_at/updated_at, descomenta la siguiente línea:
    // public $timestamps = false;
}
