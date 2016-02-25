<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfileRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ( $this->request->get( 'id' ) == \Auth::id() );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch( $this->method )
        {
            case 'GET':
            case 'DELETE':
                return [];
            break;

            case 'POST':
                return [
                    'username' => 'required|max:255|alpha_num|unique:users',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:8',
                ];
            break;

            case 'PUT':
            case 'PATCH':
                return [
                    //'username' => 'required|max:255|alpha_num',
                    'email' => 'required|email|max:255',
                ];
            break;

            default:
            break;
        }
    }
}
