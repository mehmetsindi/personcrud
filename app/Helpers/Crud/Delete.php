<?php

namespace App\Helpers\Crud;

use Exception;
use Illuminate\Database\Eloquent\Model;


trait Delete
{
    public function getDelete($model)
    {
        try {
            if (!($model instanceof Model)) {
                throw new \ErrorException('model is not correct');
            }

            $model->where('slug', request('slug'))->delete();

            return true;
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => 'record is not deleted, integrity constraint violation'
            ];
        }
    }
}
