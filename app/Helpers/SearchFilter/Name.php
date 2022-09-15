<?php

namespace App\Helpers\SearchFilter;

use Illuminate\Support\Facades\DB;

class Name extends Filters
{
    protected function filter($builder)
    {
        $name =  request('data.0.name');

        try {
            // if system info is exists
            //$builder->first()->systemInfo();
            $builder = $builder->whereRelation('systemInfo' , 'language', request('data.0.language'));

            $builder = $builder->whereHas('systemInfo', function ($query) use ($name) {
                return $query
                    ->where('name', "ILIKE", DB::raw("'%$name%'"))
                    ->orWhere('description', "ILIKE", DB::raw("'%$name%'"));
            });
        }
        catch (\Exception $e) {
            $builder = $builder->where('name', 'ILIKE', "%$name%");
        }
        return $builder;
    }
}
