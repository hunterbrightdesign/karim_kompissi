<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question_responce extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'responce',
        'status',
        'created_at',
        'updated_at',
      ];
}
