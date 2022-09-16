<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use App\Helpers\Crud\Create;
use App\Helpers\Crud\Read;
use App\Helpers\Crud\Update;
use App\Helpers\Crud\Delete;

trait Picker
{

    use Constants, Create, Read, Update, Delete;

    public function pickUp()
    {
        try {

            $fuse = $this->getFuse();
            $fuseAction = $this->getFuseAction();

            if (!in_array($fuse, array_keys($this->fuse()))) {
                throw new \Exception('fuse is not correct');
            }

            if (!in_array($fuseAction, array_keys($this->fuseAction()))) {
                throw new \Exception('fuse action is not correct');
            }

            $model = $this->pickModel($fuse);
            $method = $this->pickMethod($fuseAction);

            $fuseAction = Str::ucfirst($fuseAction);

            return $this->$method(new $model);

        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }

    public function getFuse()
    {
        $fuse = request('fuse');

        $fuse = $fuse ?? request()->path();

        return $fuse;
    }

    public function getFuseAction()
    {
        $fuseAction = request('fuseAction');
        $fuseAction = $fuseAction ?? 'read';

        return $fuseAction;
    }


    private function pickMethod($fuseAction)
    {
        $data = $this->fuseAction();
        return $data[$fuseAction];
    }


    private function pickModel($fuse)
    {
        return $this->fuse()[$fuse];
    }
}
