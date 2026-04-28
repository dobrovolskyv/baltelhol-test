<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class ProductFilter
{
    protected array $keys = [
        'category_name',
    ];

    public function apply(Builder $builder, array $data)
    {
        foreach ($this->keys as $key) {
            if (isset($data[$key])) {
                $methodName = Str::camel($key);
                $this->$methodName($builder, $data[$key]);
            }
        }

        return $builder;
    }


    private function categoryName(Builder $builder, $value): void
    {
        $builder->whereRelation('category', 'name',  'ilike', $value);
    }


}
