<?php
/**
 * Created by PhpStorm.
 * User: lisa
 * Date: 11/13/17
 * Time: 7:46 PM
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Profile extends FormRequest
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
        $rules = [
            'name' => 'required',
            'password' => 'present',
            'email' => 'email|unique:users,email,' . auth()->user()->id
        ];

        //We only want to apply these validation rules if password isn't empty
        if ( !empty( $this->get( 'password', '' ) ) ) {
            $rules[ 'password' ] = 'required|min:8|confirmed';
        }

        return $rules;
    }
}
