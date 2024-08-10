<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

# 
use App\Models\Employee;

class WorkSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_of_week',
        'start_time',
        'end_time'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_schedules')->withTimestamps();
    }

}
