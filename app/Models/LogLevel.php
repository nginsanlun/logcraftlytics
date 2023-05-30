<?php
namespace App\Models;

use App\Models\Raw;
use App\Models\LogAnalytic;
use Illuminate\Database\Eloquent\Model;

class LogLevel extends Model
{
    protected $table = 'log_levels';

    protected $fillable = [
        'level'
    ];

    public function logAnalytic()
    {
        return $this->belongsTo(LogAnalytic::class);
    }

    public function raw()
    {
        return $this->hasMany(Raw::class);
    }
}