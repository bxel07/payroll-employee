<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Exception;

class WorkScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = WorkSchedule::paginate(10);
        return view('components.admin.schedule-index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('components.admin.schedule-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validatedData = $request->validate([
                'day_of_week' => 'required|string|max:255',
                'start_time' => 'required|date_format:H:i:s',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);

            WorkSchedule::create($validatedData);

            DB::commit();

            return redirect()->route('schedule.index')->with('success', 'Work schedule created successfully.');
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WorkSchedule $workSchedule)
    {
        return view('components.admin.schedule-show', compact('workSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $workSchedule = WorkSchedule::findOrFail($id);

        return view('components.admin.schedule-edit', compact('workSchedule'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            // Validate request data
            $validatedData = $request->validate([
                'day_of_week' => 'required|string|max:255',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);

            // Find the WorkSchedule model by ID
            $schedule = WorkSchedule::findOrFail($id);

            // Update the model with validated data
            $schedule->update($validatedData);

            DB::commit();

            return redirect()->route('schedule.index')->with('success', 'Work schedule updated successfully.');
        } catch (ValidationException $e) {
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WorkSchedule $workSchedule)
    {
        DB::beginTransaction();

        try {
            $workSchedule->delete();

            DB::commit();

            return redirect()->route('schedule.index')->with('success', 'Work schedule deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }
}
