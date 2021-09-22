<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWordRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'unique:words,name,'.$this->word->id],
            'translation' => ['required', 'string'],
            'other_meanings' => ['nullable'],
            'grammar_class_id' => ['required', 'exists:grammar_classes,id'],
            'added_by' => ['required', 'exists:users,id'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'added_by' => auth()->id(),
            'other_meanings' => json_encode(request('meanings')),
        ]);
    }
}
