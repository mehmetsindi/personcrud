<?php

namespace App\Modules\Person\Validation;

use Illuminate\Support\Facades\Validator;

class PersonStoreValidation
{
    public function postValidate()
    {
        $validator = Validator::make(request()->all(),
            [
                'name' => ['required' , 'max:255', 'min:2'],
            ]
        );

        return [
            'status' => $validator->fails() ? true : false,
            'message' => $validator->errors()->toArray() ?? 'Custom Validate No Error'
        ];
    }
}
