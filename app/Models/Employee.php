<?php

namespace App\Models;

# laravel lib
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

# Another Models (for relation purpose)
use App\Models\Salary;
use App\Models\Attendance;
use App\Models\WorkSchedule;


class Employee extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = 'string';
    public $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'position',
        'hire_date'
    ];
    protected $casts = [
        'hire_date' => 'date:Y-m-d', // Automatically casts hire_date to a Carbon instance
    ];

    public function salary()
    {
        return $this->hasOne(Salary::class);
    }


    public function workSchedules(){
        return $this->belongsToMany(WorkSchedule::class, 'employee_schedules')->withTimestamps();

    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    protected static function boot()
    {
        parent::boot();

        // Generate a UUID for the primary key
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }
}
