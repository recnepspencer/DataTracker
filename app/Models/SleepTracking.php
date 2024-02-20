<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SleepTracking extends Model
{
    use HasFactory;

    protected $table = 'sleep_tracking';

    protected $fillable = ['user_id', 'sleep_time', 'awake_time', 'sleep_quality'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}