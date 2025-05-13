<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use DataTables;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Department::query();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('is_active', function($row){
                        if ($row->is_active) {
                            return '<span class="badge bg-success">Active</span>';
                        } else {
                            return '<span class="badge bg-warning">In Active</span>';
                        }
                    })
                    ->addColumn('action', function($row){      
                        return view('departments.components.action', compact('row'));
                    })
                    ->rawColumns(['is_active','action'])
                    ->make(true);
            return view('departments.index', $data);
        }
        return view('departments.index');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'is_active' => 'required|in:0,1',
            ]);
            $user = Department::create([
                                'name' => $request->name,
                                'is_active' => $request->is_active,
                            ]);
            
            return redirect()->back()->with('success', 'Added Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['department'] = Department::find($id);
        return view('departments.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'is_active' => 'required|in:0,1',
            ]);
            $department = Department::find($id);
            $department->update([
                            'name' => $request->name,
                            'is_active' => $request->is_active,
                        ]);
            
            return redirect()->back()->with('success', 'Updated Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        try {
            $department = Department::find($request->id);
            $department->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
