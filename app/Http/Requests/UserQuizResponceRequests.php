<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserQuizResponceRequests extends FormRequest {
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
        'quiz_questions_id' => 'int|required|exists:quiz_questions,id',
        'question_responces_id' => 'int|required|exists:question_responces,id',
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
