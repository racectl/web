<?php


namespace App\Actions;


use App\Contracts\Jsonable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 *
 */
class GenerateJsonForFile
{
    /**
     * @param Jsonable|Model $model
     *
     * @return string
     */
    public static function fromModel(Jsonable $model)
    {
        $propertiesNotIncluded = $model->jsonableExcludes ?? [];
        $collection = collect($model->getAttributes())
            ->except($propertiesNotIncluded)
            ->whereNotNull()
            ->mapWithKeys(function ($value, $key) {
                return [Str::camel($key) => $value];
            });

        return $collection->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . "\n";
    }
}
