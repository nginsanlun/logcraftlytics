<?php
namespace App\Models;

use App\Models\LogAnalytic;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    protected $table = 'methods';

    protected $fillable = [
        'name'
    ];

    public function logAnalytic()
    {
        return $this->hasOne(LogAnalytic::class);
    }
}
