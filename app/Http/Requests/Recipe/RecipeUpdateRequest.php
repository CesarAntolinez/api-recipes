<?php

namespace App\Http\Requests\Recipe;

use Illuminate\Foundation\Http\FormRequest;

class RecipeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:100|string',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'preparation' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'published_at' => 'nullable|datetime',
            'category_id' => 'required|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'required|exists:tags,id',
        ];
    }

    /** @return void */
    protected function prepareForValidation(): void
    {
        if ($this->has('tags') && !is_array($this->tags)) {
            $this->merge(['tags' => explode(',', $this->tags)]);
        }
    }
}
