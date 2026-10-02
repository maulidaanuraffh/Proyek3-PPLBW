<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateActivityRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'category_id' => ['required', 'exists:categories,id'],
            'code' => ['required', 'string', 'max:30', 'unique:activities,code,' . $this->route('activity')->id],
            'title'       => ['required', 'string', 'min:5', 'max:150'],
            'description' => ['nullable', 'string', 'max:1000'],
            'location'    => ['nullable', 'string', 'max:150'],
            'capacity'    => ['required', 'integer', 'min:1', 'max:500'],
            'start_at'    => ['required', 'date'],
            'end_at'      => ['required', 'date', 'after_or_equal:start_at'],
            'status'      => ['required', 'in:draft,published,completed'],
        ];
    }
}
