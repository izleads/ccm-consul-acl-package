<?php

namespace ConsulConfigManager\Consul\ACL\Http\Requests\Policy;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PolicyCreateRequest
 * @package ConsulConfigManager\Consul\ACL\Http\Requests\Policy
 */
class PolicyCreateUpdateRequest extends FormRequest
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
            'name'          =>  ['required', 'max:60'],
            'description'   =>  ['string', 'max:255'],
            'rules'         =>  ['string'],
        ];
    }
}
