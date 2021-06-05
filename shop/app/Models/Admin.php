<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    use SoftDeletes;

    protected $table = 'admins';

    protected $guarded = [];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'status',

    ];


}
