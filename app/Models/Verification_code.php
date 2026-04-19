<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification_code extends Model
{
    /** @use HasFactory<\Database\Factories\VerificationCodeFactory> */
    use HasFactory;
    protected $guarded = ['id'];
}
