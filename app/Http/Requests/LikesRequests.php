<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequests extends FormRequest {
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
        'user_id' => 'int|required',
        'model_type' => 'string|required|max:5',
        'model_id' => 'int|required|exists:posts,id',
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
