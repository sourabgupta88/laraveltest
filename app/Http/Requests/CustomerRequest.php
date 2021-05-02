<?php

namespace App\Http\Requests;

use App\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;
use Request;

class CustomerRequest extends FormRequest
{
    
    public static $mobilePhoneRegexMessage = 'The :attribute must be a valid phone number';
    
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
      $request = $this;
     
      $phoneValidation = ["regex:/^(?:\+?61)?(?:\(0\)[23478]|\(?0?[23478]\)?)\d{8}$/","min:10",'numeric','digits_between:10,10'];
     
      $customerCreateRules = [
        'first_name' => 'required|max:60',
        'middle_name' => 'present|max:60',
        'last_name' => 'required|max:60',
        'dob' => 'required|date_format:Y-m-d|before:18 years ago',
        'email' => 'required|unique:customers,email|email:rfc,dns|max:100',
        'mobile_phone' => array_merge(['required'],$phoneValidation),
        'address' => 'required',
        'current_unit_number' => 'present|max:50',
        'current_street_number' => 'required|max:100',
        'current_street_name' => 'required|max:100',
        'current_street_type' => 'required|'.Rule::in(Customer::$streetTypes),
        'current_suburb' => 'required|max:100',
        'current_postcode' => 'required|digits_between:1,10',
        'current_state' => 'required|'.Rule::in(Customer::$states),
        'marital_status' => 'required|'.Rule::in(Customer::$maritalStatus),
       	'gender' => 'required|'.Rule::in(Customer::$genderTypes),
      ];

      return $customerCreateRules;
    }

    protected function getValidatorInstance()
    {
        //here we can replace request
        return parent::getValidatorInstance();
    }

    
     public function messages()
    {
        return [
        'mobile_phone.regex' => static::$mobilePhoneRegexMessage,
        ];
    }
}
