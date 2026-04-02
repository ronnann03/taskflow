<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'role',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}