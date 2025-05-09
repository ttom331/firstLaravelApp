<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use PDO;

class Employer extends Model
{
    /** @use HasFactory<\Database\Factories\EmployerFactory> */
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class); //an employer belongs to one user
    }

    public function jobs(){ //employer has many jobs
        return $this->hasMany(Job::class);
    }
}
