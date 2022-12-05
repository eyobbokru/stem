<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'sex' => 'required',
            'age' => 'required',
            'grade_id' => 'required',
            'school_id' => 'required',
            'academic_session_id' => 'required',
            'group_id' => 'required',

        ];
    }
}
