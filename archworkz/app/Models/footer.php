<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class footer extends Model
{
    protected $fillable = ['location', 'phone_number','company_number', 'website'];
}
