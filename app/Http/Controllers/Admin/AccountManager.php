<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;


class AccountManager extends Controller
{
    public function index()
    {
        $admins = Admin::paginate(10);
        return view("components.admin.account-index", compact("admins"));
    }

    public function create()
    {
        return view('components.admin.account-create');
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admins',
                'password' => 'required|string|min:8|confirmed',
            ]);

            DB::beginTransaction();

            Admin::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            DB::commit();

            return redirect()->route('account.index')->with('success', 'Admin created successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Database error: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function show(string $id)
    {
        try {
            $admin = Admin::findOrFail($id);
            return view('components.admin.account-show', compact('admin'));
        } catch (\Exception $e) {
            return redirect()->route('account.index')->with('error', 'Admin not found.');
        }
    }

    public function edit(string $id)
    {
        try {
            $admin = Admin::findOrFail($id);
            return view('components.admin.account-edit', compact('admin'));
        } catch (\Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Admin not found.');
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $admin = Admin::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admins,email,'. $id,
                'password' => 'nullable|string|min:8|confirmed',
            ]);

            DB::beginTransaction();

            $admin->name = $validatedData['name'];
            $admin->email = $validatedData['email'];
            
            if (!empty($validatedData['password'])) {
                $admin->password = Hash::make($validatedData['password']);
            }

            $admin->save();

            DB::commit();

            return redirect()->route('account.index')->with('success', 'Admin updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Database error: ' . $e->getMessage())->withInput();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            DB::beginTransaction();

            $admin = Admin::findOrFail($id);
            $admin->delete();

            DB::commit();

            return redirect()->route('account.index')->with('success', 'Admin deleted successfully.');
        } catch (QueryException $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Database error: ' . $e->getMessage());
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }
}
