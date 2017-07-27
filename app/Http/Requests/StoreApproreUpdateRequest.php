<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApproreUpdateRequest extends FormRequest
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
        if($this->input('revision') == 1)
            return [];
        return [
            'final_amount' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'final_amount.required' => 'Jumlah Dana Perbaikan harus diisi'
        ];
    }
}
