<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditorMedia extends Model
{
    /** @use HasFactory<\Database\Factories\EditorMediaFactory> */
    use HasFactory;
    protected $guarded = ['id'];
}
