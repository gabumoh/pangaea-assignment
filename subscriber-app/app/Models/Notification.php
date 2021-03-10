<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['endpoint', 'topic', 'data'];
    protected $hidden = ['id', 'created_at', 'updated_at'];
}
