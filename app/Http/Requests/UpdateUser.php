<?php namespace App\Http\Requests;
/**
 * @copyright Copyright (c) 2023 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Valida la actualización de los usuarios
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb.com>
 * 
 * @version 1.0.0
 */
class UpdateUser extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'paternal' => ['required', 'string'],
            'maternal' => ['nullable', 'string'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->id)],
            'phone' => ['nullable', 'numeric', Rule::unique('users')->ignore($this->id)],
        ];
    }
}
