<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLuckyDrawRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'amount' => 'required|max:7',
            'donor' => [
                'required',
                Rule::unique('invoices')
                    ->where('amount', $this->amount)
                    ->where('address',$this->address)
                ],
//            'mtl' => 'required',
//            'mtl_value' => 'required|max:7',
            'address' => 'required',
        ];
    }

}
