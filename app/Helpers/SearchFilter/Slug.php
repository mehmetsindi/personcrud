<?php

namespace App\Helpers\SearchFilter;

class Slug extends Filters
{
    protected function filter($builder)
    {
        return $builder->where('slug',  request('slug'));
    }
}
