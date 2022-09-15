<?php

namespace App\Modules\Address\Validation;

use Illuminate\Support\Facades\Validator;

class AddressStoreValidation
{
    public function postValidate()
    {
        $validator = Validator::make(request()->all(),
            [
                'address' => ['required' , 'max:500', 'min:5'],
            ]
        );

        return [
            'status' => $validator->fails() ? true : false,
            'message' => $validator->errors()->toArray() ?? 'Custom Validate No Error'
        ];
    }
}
