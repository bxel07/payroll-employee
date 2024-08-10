<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class EmployeeScheduleController extends Controller
{
    /**
     * Show the form for assigning employees to a work schedule.
     */
    public function create()
    {
        $schedules = WorkSchedule::all();
        $employees = Employee::all();
        return view('admin.employee-schedule-create', compact('schedules', 'employees'));
    }

    /**
     * Store a newly created assignment in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'work_schedule_id' => 'required|exists:work_schedules,id',
                'employees' => 'required|array',
                'employees.*' => 'exists:employees,id',
            ]);

            $workSchedule = WorkSchedule::findOrFail($validatedData['work_schedule_id']);
            $workSchedule->employees()->sync($validatedData['employees']);

            DB::commit();

            return redirect()->route('employee-schedule.create')->with('success', 'Employees assigned successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the assigned employees.
     */
    public function edit(WorkSchedule $workSchedule)
    {
        $employees = Employee::all();
        $assignedEmployees = $workSchedule->employees->pluck('id')->toArray();

        return view('admin.employee-schedule-edit', compact('workSchedule', 'employees', 'assignedEmployees'));
    }

    /**
     * Update the assigned employees.
     */
    public function update(Request $request, WorkSchedule $workSchedule)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'employees' => 'required|array',
                'employees.*' => 'exists:employees,id',
            ]);

            $workSchedule->employees()->sync($validatedData['employees']);

            DB::commit();

            return redirect()->route('employee-schedule.create')->with('success', 'Employee assignments updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }
}
