<?php

namespace App\Helpers;

trait Constants
{

    public function genderType()
    {
        return [
            'male',
            'female',
            'other'
        ];
    }

    public function fuse()
    {
        return [
            'person' => '\App\Modules\Person\Models\PersonModel',
            'address' => '\App\Modules\Address\Models\AddressModel'
        ];
    }


    public function fuseAction()
    {
        return [
            'create' => 'getCreate',
            'store' => 'getStore',
            'update' => 'getUpdate',
            'read' => 'getRead',
            'delete' => 'getDelete'
            //'import'
            //'export'
        ];
    }


    public function validation()
    {
        return [
            'store' => [
                'person' => '\App\Modules\Person\Validation\PersonStoreValidation',
                'address' => '\App\Modules\Address\Validation\AddressStoreValidation'
            ],
        ];
    }

}
