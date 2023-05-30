<?php
namespace App\Contracts;

use App\Models\LogAnalytic;
use Illuminate\Database\Eloquent\Collection;

interface LogAnalyticModuleInterface 
{
    public function getLogAnalyticByFilter(string $date, ?string $routeId, ?string $methodId, ?string $statusId): Collection|null;

    public function showLogAnalyticList(int $count);
    
    public function findLogAnalyticById(int $id): ?Collection ;

}