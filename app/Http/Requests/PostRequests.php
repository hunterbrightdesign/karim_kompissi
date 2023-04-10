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
        'title' => 'string|required|max:191',
        'slug' => 'string|max:191',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
