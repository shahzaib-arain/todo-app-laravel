<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    

use HasFactory;

    protected $fillable = ['name']; // 👈 allow mass assignment

    public $timestamps = false; // 👈 if you don't have created_at/updated_at columns

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
