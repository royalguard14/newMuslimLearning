<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotationTitleRequest extends FormRequest
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
            //

           'quotation_name' => 'required',
            'title'=>'required',
            'sales_designer'=>'required',
            'sales_manager'=>'required',
            'prj_id'=>'required',
        ];
    }
}
