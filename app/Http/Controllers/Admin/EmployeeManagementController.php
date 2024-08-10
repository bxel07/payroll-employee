<?php

namespace App\Http\Controllers\Admin;
use App\Models\Employee;
use App\Models\WorkSchedule;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;
use Exception;


class EmployeeManagementController extends Controller
{
    // Display a listing of the employees
    public function index()
    {
        $employees = Employee::with('salary')->paginate(10);
        return view('components.admin.employee-index', compact('employees'));
    }

    // Show the form for creating a new employee
    public function create()
    {
        $workSchedules = WorkSchedule::all();
        return view('components.admin.employee-create', compact('workSchedules'));    }

    // Store a newly created employee in storage
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'nullable|string|max:255',
                'phone_number' => 'nullable|string|max:255',
                'position' => 'required|string|max:255',
                'hire_date' => 'required|date',
                'base_salary' => 'nullable|numeric|min:0',
                'allowance' => 'nullable|numeric|min:0',
                'work_schedules' => 'required|array',
                'work_schedules.*' => 'exists:work_schedules,id',
            ]);
    
            $employee = Employee::create([
                'name' => $validatedData['name'],
                'address' => $validatedData['address'],
                'phone_number' => $validatedData['phone_number'],
                'position' => $validatedData['position'],
                'hire_date' => $validatedData['hire_date'],
            ]);
    
            if (isset($validatedData['base_salary']) || isset($validatedData['allowance'])) {
                $employee->salary()->create([
                    'base_salary' => $validatedData['base_salary'] ?? 0,
                    'allowance' => $validatedData['allowance'] ?? 0,
                ]);
            }
    
            $employee->workSchedules()->attach($validatedData['work_schedules']);
    
            DB::commit();
    
            return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
        } catch (ValidationException $e) {
            dd($e->getMessage(), $e->getLine());
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            dd($e->getMessage(), $e->getLine());

            DB::rollBack();
            return redirect()->back()->with('error', 'Database error: ' . $e->getMessage())->withInput();
        } catch (Exception $e) {
            dd($e->getMessage(), $e->getLine());

            DB::rollBack();
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }

    // Display the specified employee
    public function show(Employee $employee)
    {
        return view('components.admin.employee-show', compact('employee'));
    }

    // Show the form for editing the specified employee
    public function edit(Employee $employee)
    {
        // Load the salary and work schedules relationships
        $employee->load('salary', 'workSchedules');
    
        // Get all work schedules
        $workSchedules = WorkSchedule::all();

        return view('components.admin.employee-edit', compact('employee', 'workSchedules'));
    }

    // Update the specified employee in storage
    public function update(Request $request, Employee $employee)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'nullable|string|max:255',
                'phone_number' => 'nullable|string|max:255',
                'position' => 'required|string|max:255',
                'hire_date' => 'required|date',
                'base_salary' => 'nullable|numeric|min:0',
                'allowance' => 'nullable|numeric|min:0',
                'work_schedules' => 'required|array',
                'work_schedules.*' => 'exists:work_schedules,id',
            ]);
    
            $employee = Employee::create([
                'name' => $validatedData['name'],
                'address' => $validatedData['address'],
                'phone_number' => $validatedData['phone_number'],
                'position' => $validatedData['position'],
                'hire_date' => $validatedData['hire_date'],
            ]);
    
            if (isset($validatedData['base_salary']) || isset($validatedData['allowance'])) {
                $employee->salary()->create([
                    'base_salary' => $validatedData['base_salary'] ?? 0,
                    'allowance' => $validatedData['allowance'] ?? 0,
                ]);
            }
    
            $employee->workSchedules()->attach($validatedData['work_schedules']);
    
            DB::commit();
    
            return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Database error: ' . $e->getMessage())->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }

    // Remove the specified employee from storage
    public function destroy(Employee $employee)
    {
        DB::beginTransaction();

        try {
            // Delete related salary record if exists
            if ($employee->salary) {
                $employee->salary()->delete();
            }
    
            // Delete the employee record
            $employee->delete();
    
            DB::commit();
    
            return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Database error: ' . $e->getMessage())->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }
}
