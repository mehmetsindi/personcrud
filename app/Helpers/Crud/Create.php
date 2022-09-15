<?php

namespace App\Helpers\Crud;

use App\Helpers\Contstants;
use Illuminate\Support\Str;
use App\Helpers\SlugGenerator;
use Exception;
use Illuminate\Database\Eloquent\Model;

trait Create
{
    use Contstants;

    public function getCreate($model)
    {
        return true;
    }

    public function getStore($model)
    {

        try {
            if (!($model instanceof Model)) {
                throw new \ErrorException('model is not correct');
            }

            if ($this->validator()['status']) {
                throw new \ErrorException($this->validator()['message']['name'][0] ?? 'validation error');
            }

            $model->slug = SlugGenerator::generateSlug();

            foreach ($model->getFillable() as $m) {
                $model->$m = request(Str::camel($m));
            }

            $model->is_active = 1;

            if (!$model->save()) {
                return  new Exception('failed to save');
            }
            return true;
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }



    private function validator(){

        $validation = $this->validation();

        $validation = $validation[request('fuseAction')][request('fuse')];

        return (new $validation)->postValidate();

    }
}
