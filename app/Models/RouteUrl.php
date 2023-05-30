<?php
namespace App\Models;

use App\Models\LogAnalytic;
use Illuminate\Database\Eloquent\Model;

class RouteUrl extends Model
{
    protected $table = 'routes';

    protected $fillable = [
        'name',
    ];

    public function logAnalytic()
    {
        return $this->hasOne(LogAnalytic::class);
    }
}