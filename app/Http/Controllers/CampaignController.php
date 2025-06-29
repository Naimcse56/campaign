<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignFormField;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Campaign::query()->with('shop');
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('is_active', function ($row) {
                    if ($row->is_active) {
                        return '<span class="badge bg-success">Active</span>';
                    } else {
                        return '<span class="badge bg-warning">In Active</span>';
                    }
                })
                ->addColumn('action', function ($row) {
                    return view('campaign.components.action', compact('row'));
                })
                ->rawColumns(['is_active', 'action'])
                ->make(true);
            return view('campaign.index', $data);
        }
        $data['shops'] = Shop::where('is_active', 1)->get(['id', 'name']);
        return view('campaign.index', $data);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title'      => ['required', 'string', 'max:255'],
                'shop_id'    => ['required', 'exists:shops,id'],
                'start_date' => ['required', 'date'],
                'end_date'   => ['required', 'date', 'after_or_equal:start_date'],
                'details'    => ['nullable', 'string'],
                'is_active'  => ['required', 'boolean'],
            ]);

            Campaign::create([
                'title' => $request->title,
                'shop_id' => $request->shop_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'details' => $request->details,
                'is_active' => $request->is_active,
            ]);
            return redirect()->back()->with('success', 'Added Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $data['campaign'] = Campaign::with('shop:id,name')->find($id);
        $data['shops'] = Shop::where('is_active', 1)->get(['id', 'name']);
        return view('campaign.edit', $data);
    }

    public function show($id)
    {
        $data['campaign'] = Campaign::with('shop:id,name')->find($id);
        return view('campaign.show', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title'      => ['required', 'string', 'max:255'],
                'shop_id'    => ['required', 'exists:shops,id'],
                'start_date' => ['required', 'date'],
                'end_date'   => ['required', 'date', 'after_or_equal:start_date'],
                'details'    => ['nullable', 'string'],
                'is_active'  => ['required', 'boolean'],
            ]);
            $campaign = Campaign::find($id);
            $campaign->update([
                'title' => $request->title,
                'shop_id' => $request->shop_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'details' => $request->details,
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
            $campaign = Campaign::find($request->id);
            $campaign->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function createForm(Campaign $campaign)
    {
        $data['campaign'] = $campaign;
        $data['fields'] = $campaign->formFields;
        return view('campaign.form_create', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function showForm(Campaign $campaign)
    {
        $data['campaign'] = $campaign;
        $data['fields'] = $campaign->formFields;
        return view('campaign.form', $data);
    }

    public function saveFormFields(Request $request, Campaign $campaign)
    {
        $rules = [
            'fields' => 'required|array|min:1',
            'fields.*.label' => 'required|string|max:255',
            'fields.*.name' => 'required|alpha_dash|max:255',
            'fields.*.type' => 'required|in:text,textarea,select,radio,checkbox,email,number,date',
            'fields.*.options' => 'nullable|string',
            'fields.*.required' => 'nullable|boolean',
        ];

        Validator::make($request->all(), $rules)->validate();

        // Optional: clear old fields first (if updating)
        CampaignFormField::where('campaign_id', $campaign->id)->delete();

        foreach ($request->fields as $order => $field) {
            $options = null;
            if (!empty($field['options'])) {
                $decoded = json_decode($field['options'], true);
                $options = is_array($decoded)
                    ? array_map(fn($opt) => is_array($opt) ? ($opt['value'] ?? '') : $opt, $decoded)
                    : explode(',', $field['options']);
            }

            CampaignFormField::create([
                'campaign_id' => $campaign->id,
                'label' => $field['label'],
                'name' => Str::slug($field['name'], '_'),
                'type' => $field['type'],
                'required' => isset($field['required']),
                'options' => $options,
                'order' => $order,
            ]);
        }

        return redirect()->back()->with('success', 'Form fields updated successfully.');
    }

    public function getQr(Campaign $campaign)
    {
        $data['campaign'] = $campaign->load('shop:id,name,slug');
        return view('campaign.get_qr_code', $data);
    }
}
