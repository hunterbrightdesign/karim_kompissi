<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;
    protected $fillable = [
        'quiz_id',
        'title',
        'number',
        'created_at',
        'updated_at',
      ];
      public function getResponce() {
        return $this->hasMany(QuestionResponce::class);
      }
      public function getUserResponce() {
        return $this->hasMany(UserQuizResponce::class,'quiz_questions_id');
      }
      public function getQuiz() {
        return $this->belongsToMany(Quiz::class,'quiz_id');
      }
}
