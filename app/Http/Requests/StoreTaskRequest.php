<?php

namespace App\Http\Requests;

use App\Enums\IndexModels;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreTaskRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            "user_id" => Auth::id(),
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "user_id" => ["required",Rule::exists("users",'id')],
            "index_name" => ["required" , new Enum(IndexModels::class)],
            "keyword" => "required|min:2|max:255"
        ];
    }
}
