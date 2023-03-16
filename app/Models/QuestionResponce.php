<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionResponce extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'responce',
        'status',
        'created_at',
        'updated_at',
      ];
      public function getQuestion() {
        return $this->belongsToMany(QuizQuestion::class,'question_id');
      }
}
