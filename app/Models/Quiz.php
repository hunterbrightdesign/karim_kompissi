<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'desc',
        'created_at',
        'updated_at',
      ];
      public function getQuestion() {
        return $this->hasMany(QuizQuestion::class);
      }
}
