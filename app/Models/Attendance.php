<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

# Another Models (for relation purpose)
use App\Models\Employee;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'check_in',
        'check_out' ,
        'status'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
