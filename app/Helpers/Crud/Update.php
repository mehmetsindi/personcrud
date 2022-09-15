<?php

namespace App\Helpers\Crud;

use Illuminate\Support\Str;
use App\Helpers\UpdateHelper;
use Illuminate\Database\Eloquent\Model;

trait Update
{
    public function getUpdate($model)
    {
        try {
            if (!($model instanceof Model)) {
                throw new \ErrorException('model is not correct');
            }

            $data = request()->all();

            $pickUpdate = UpdateHelper::setUpdate($model, $data);

            $model = $model->where('slug', request('slug'))->first();

            foreach ($pickUpdate as $m) {
                !array_key_exists(Str::camel($m), $data) ?: $model->$m = $data[Str::camel($m)] ?? null;
            }

            if (!$model->save()) {
                throw new \ErrorException('could not update');
            }
            return $data;

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
