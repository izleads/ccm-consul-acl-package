<?php

namespace ConsulConfigManager\Consul\ACL\Http\Requests\Token;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TokenCreateRequest
 * @package ConsulConfigManager\Consul\ACL\Http\Requests\Token
 */
class TokenCreateUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * @return array
     */
    public function rules(): array
    {
        return [
            'description'       =>  ['string', 'max:255'],
            'roles'             =>  ['array'],
            'policies'          =>  ['array'],
            'local'             =>  ['boolean'],
        ];
    }
}
