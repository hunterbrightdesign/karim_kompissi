<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequests extends FormRequest {
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
        'title' => 'string|required|max:191',
        'desc' => 'string|required|max:191',
        'link' => 'string|required|unique:Video|max:191',
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
