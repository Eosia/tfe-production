<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    City,
    User,
    Job
};

class Province extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /*
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
    */


}
