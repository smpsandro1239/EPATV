<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->user()->role === 'company';
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:areas_of_interest,id',
            'description' => 'required|string|min:100',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'contract_type' => 'required|in:full-time,part-time,internship,freelance',
            'expiration_date' => 'required|date|after:today',
        ];
    }
}
