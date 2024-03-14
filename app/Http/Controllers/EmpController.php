<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;

class EmpController extends Controller
{
    public function index()
    {
        $emp = Employee::orderBy('display_order', 'ASC')->get();
        return view('emploee', compact('emp'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'salary' => 'required',
            // 'gender' => 'required',
        ]);

        try {
            $emp = Employee::create([
                'name' => $request->name,
                'designation' => $request->designation,
                'salary' => $request->salary,
                'gender' => $request->gender,
                'hobby' => $request->hobby,
                'status' => 'Active',
                'display_order' => 0,
                'created_date' => now(),
                'updated_date' => now(),
            ]);

            // Check if image is uploaded
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $fileName = $file->getClientOriginalName();
                    $path = 'Uploads/emp/image';
                    $file->move($path, $fileName);
                    $emp->update(['image' => $path . '/' . $fileName]);
                }
            }

            return response()->json(['status' => 'success', 'message' => 'Employee Created Successfully', 'data' => $emp], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Something went wrong!'], 500);
        }
    }


    public function reorder(Request $request)
    {
        $order = 1;
        foreach ($request->order as $orderData) {
            Employee::where('id', $orderData['id'])->update(['display_order' => $order]);
            $order++;
        }
        return response()->json(['status' => 'success', 'message' => 'Update Successfully'], 200);
    }

    public function delete(Request $request)
    {
        $emp = Employee::find($request->id);

        if (!$emp) {
            return response()->json(['error' => 'Employee not found'], 404);
        }

        $deleted = $emp->delete();

        if ($deleted) {
            return response()->json(['message' => 'Employee deleted successfully'], 200);
        } else {
            return response()->json(['error' => 'Failed to delete Employee'], 500);
        }
    }

    public function edit(Request $request)
    {
        $emp = Employee::find($request->id);
        return response()->json(['status' => 'success', 'data' => $emp], 200);
    }

    public function update(Request $request)
    {
        // dd($request->emp_id);
        $emp = Employee::where('id', $request->emp_id)->first();

        $emp->name = $request->name;
        $emp->designation = $request->designation;
        $emp->salary = $request->salary;
        $emp->gender = $request->gender;
        $emp->hobby = $request->hobby;
        $emp->updated_date = now();
        if ($request->hasFile('image')) {
            if (File::exists($emp->logo)) {
                File::delete($emp->logo);
            }
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $path = 'Uploads/emp/image/';
            $file->move($path, $filename);
            $full_path = $path . $filename;
            $emp->image = $full_path;
        }
        $emp->save();
        return back()->with(['msg' => 'Emploee Data update successfully!']);
    }
}
