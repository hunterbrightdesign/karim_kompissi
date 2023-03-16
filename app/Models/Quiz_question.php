<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz_question extends Model
{
    use HasFactory;
    protected $fillable = [
        'quiz_id',
        'title',
        'number',
        'created_at',
        'updated_at',
      ];
}
