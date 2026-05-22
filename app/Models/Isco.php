<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isco extends Model
{
    use HasFactory;

    protected $fillable = ['level', 'code', 'title_en', 'title_id'];
}
