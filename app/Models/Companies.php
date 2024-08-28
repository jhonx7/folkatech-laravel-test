<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Companies extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'email',
        'website',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employees::class);
    }
}
