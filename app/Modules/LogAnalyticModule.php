<?php
namespace App\Modules;

use App\Models\LogAnalytic;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\LogAnalyticModuleInterface;

class LogAnalyticModule implements LogAnalyticModuleInterface 

{
    public function __construct(
        protected LogAnalytic $logAnalytic,
    ) {    
    }

    public function getLogAnalyticByFilter(string $date, ?string $routeId, ?string $methodId, ?string $statusId): Collection|null
    {
        $query = null;

        if ($date) {
            $query = $this->logAnalytic->whereDate('created_at', $date);
        }

        if ($routeId) {
            $query = $query ?->where('route_id', $routeId);
        }

        if ($methodId) {
            $query = $query ?->where('method_id', $methodId);
        }

        if ($statusId) {
            $query = $query ?->where('status_id', $statusId);
        }

        if ($query) {
            return $query->with(['route', 'method', 'status'])->get();
        }
        
        return null;
    }

    public function showLogAnalyticList(int $count)
    {
        return $this->logAnalytic->with(['logLevel', 'route', 'method', 'status'])->paginate($count);
    }

    public function findLogAnalyticById(int $id): ?Collection
    {
        $logAnalytic = $this->logAnalytic->where('id', $id)
        ->with(['route', 'method', 'status'])
        ->get();
        if ($logAnalytic) {
            return $logAnalytic;
        }
        return null;
    }
}
