<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isic extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'title_en', 'title_id'];
}
