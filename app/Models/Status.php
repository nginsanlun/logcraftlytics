<?php
namespace App\Models;

use App\Models\LogAnalytic;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $table = 'statuses';

    protected $fillable = [
        'status_code'
    ];

    public function logAnalytic()
    {
        return $this->hasOne(LogAnalytic::class);
    }
}
