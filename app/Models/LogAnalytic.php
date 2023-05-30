<?php
namespace App\Models;

use App\Models\Method;
use App\Models\Status;
use App\Models\LogLevel;
use App\Models\RouteUrl;
use Illuminate\Database\Eloquent\Model;

class LogAnalytic extends Model
{
    protected $table = 'log_analytics';

    protected $fillable = [
        'log_level_id',
        'route_id',
        'status_id',
        'method_id'
    ];

    public function logLevel()
    {
        return $this->belongsTo(LogLevel::class, 'log_level_id');
    }

    public function route()
    {
        return $this->belongsTo(RouteUrl::class, 'route_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function method()
    {
        return $this->belongsTo(Method::class, 'method_id');
    }
}
