<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function competencySchemes()
    {
        return $this->hasMany(CompetencyScheme::class);
    }
}
