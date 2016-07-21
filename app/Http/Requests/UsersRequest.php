<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  //note default is false so set to true 
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //more validation look up 'laravel validations'
            'name'=> 'required',
            'email'=> 'required',
            'role_id'=> 'required',
            'is_active'=> 'required',
            'password'=> 'required'
        ];
    }
}
