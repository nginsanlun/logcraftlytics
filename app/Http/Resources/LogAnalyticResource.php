<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LogAnalyticResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

    }

    public function LogCollectionTransform()
    {
        $data = $this->collection;
        return $data->map(function ($each) {
            $each->route_name = $each?->route->name;
            $each->method_name = $each?->method->name;
            $each->status_code = $each?->status->status_code;
            $each->log_level = $each?->logLevel->level;
            unset($each->log_level_id);
            unset($each->method_id);
            unset($each->status_id);
            unset($each->route_id);
            unset($each->route);
            unset($each->method);
            unset($each->status);
            unset($each->logLevel);
            return $each;
        });
    }
}