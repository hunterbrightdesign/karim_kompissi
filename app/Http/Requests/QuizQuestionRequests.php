<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuizQuestionRequests extends FormRequest {
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules() {
    return [
        // 'user_id' => 'required|integer',
        'quiz_id' => 'int|required|exists:quizzes,id',
        'title' => 'string|required',
        'number' => 'int|required',
    ];
  }

  /**
   * Custom message for validation
   *
   * @return array
   */
  public function messages() {
    return [];
  }
}