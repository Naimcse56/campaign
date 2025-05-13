<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use DataTables;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Shop::query();
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
                        return view('shop.components.action', compact('row'));
                    })
                    ->rawColumns(['is_active','action'])
                    ->make(true);
            return view('shop.index', $data);
        }
        return view('shop.index');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'tin_no' => 'nullable|string',
                'address' => 'nullable|string',
                'phone' => 'nullable|string',
                'is_active' => 'required|in:0,1',
            ]);
            $user = shop::create([
                                'name' => $request->name,
                                'tin_no' => $request->tin_no,
                                'address' => $request->address,
                                'phone' => $request->phone,
                                'slug' => str_replace(' ','-',strtolower($request->name)).'-'.date('isY'),
                                'is_active' => $request->is_active,
                            ]);
            
            return redirect()->back()->with('success', 'Added Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['shop'] = Shop::find($id);
        return view('shop.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'tin_no' => 'nullable|string',
                'address' => 'nullable|string',
                'phone' => 'nullable|string',
                'is_active' => 'required|in:0,1',
            ]);
            $shop = Shop::find($id);
            $shop->update([
                            'name' => $request->name,
                            'tin_no' => $request->tin_no,
                            'address' => $request->address,
                            'phone' => $request->phone,
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
            $shop = Shop::find($request->id);
            $shop->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
