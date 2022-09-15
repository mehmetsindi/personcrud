<?php

namespace App\Helpers\SearchFilter;

use Closure;
use Illuminate\Support\Str;


abstract class Filters
{

    public function handle($request, Closure $next)
    {
        $builder = $next($request);

        // gelen istekte pipe parametresi yoksa ve null değer taşıyorsa filtereden geçirmeden isteği döndürüyoruz
        if (
            !request()->has($this->filterName())
            || is_null(request($this->filterName()))
        )
        {
            if (
                is_null(request('data'))
                || empty(request('data'))
                || !in_array('isActive', array_keys(request('data.0')))
            ) {
                $builder = $builder->where('is_active', true);
            } else {
                $active = request('isActive');
                if ($active === '_ALL') {
                    return $builder;
                }
                is_null($active) ? $active = true : $active = $active;
                $builder = $builder->where('is_active', $active);
            }
            return $builder;
        } else {

            return $this->filter($builder);
        }

    }


    protected abstract function filter($builder);

    protected function filterName()
    {
        $classNames = class_basename($this);
        $className = Str::replace('Filter', '', $classNames);
        return Str::camel($className);
    }
}
