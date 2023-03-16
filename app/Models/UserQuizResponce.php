<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuizResponce extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'quiz_questions_id',
        'question_responces_id',
        'created_at',
        'updated_at',
      ];
}
