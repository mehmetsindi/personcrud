<?php
namespace App\Helpers\Crud;

use Exception;
use Illuminate\Pipeline\Pipeline;
use App\Helpers\SearchFilter\Name;
use App\Helpers\SearchFilter\Slug;
use App\Helpers\SearchFilter\Sort;
use App\Helpers\SearchFilter\IsActive;
use Illuminate\Database\Eloquent\Model;


trait Read {

    public function getRead($model)
    {
        try {
            if (!($model instanceof Model)) {
                throw new \ErrorException('model is not correct');
            }
            $data = app(Pipeline::class)
                ->send($model)
                ->through(
                    Sort::class,
                    Slug::class,
                    Name::class,
                )
                ->thenReturn()
                ->requirement()
                ->paginate(12);
            return $data;

        } catch (\Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }


}
