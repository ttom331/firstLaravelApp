<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    public function employer(){ //a job belongs to an employer
        return $this->belongsTo(Employer::class);
    }

    public function tag(string $name){
        $tag = Tag::firstOrCreate(['name' => $name]); //find the first tag with that name if not, create one then give tag

        $this->tags()->attach($tag);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
