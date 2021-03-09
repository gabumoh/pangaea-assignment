<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicBody extends Model
{
    use HasFactory;
    protected $fillable = ['topic', 'data'];
    protected $hidden = ['id', 'created_at', 'updated_at'];
}
