<?php

namespace App\Helpers\SearchFilter;

class Sort extends Filters
{
    protected function filter($builder)
    {
        return $builder->orderBy(request('sortTitle') ?? 'id' , request('sort') ?? 'desc');
    }
}
