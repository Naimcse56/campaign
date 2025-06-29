<?php

namespace App\Http\Controllers;

use App\Exports\QuotesExport;
use App\Models\Campaign;
use App\Models\Quote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuoteController extends Controller
{
    public function index(Request $request)
    {
        $campaignId = $request->get('campaign_id');

        // Get the latest active campaign if no ID is given
        $campaign = $campaignId ? Campaign::findOrFail($campaignId) : Campaign::where('is_active', 1)->latest('id')->first();

        if (!$campaign) {
            return redirect()->route('campaign.index')->with('warning', 'Campaign Not Found, Please Create an Campaign');
        }
        // Build quotes query
        $quotesQuery = Quote::with(['campaign'])->where('campaign_id', $campaign->id);


        // Handle export or print first (before pagination)
        if ($request->has('csv')) {
            return Excel::download(new QuotesExport($quotesQuery->get()), 'quotes.csv');
        }

        if ($request->has('print')) {
            return view('quote.print_quote', [
                'campaign' => $campaign,
                'quotes' => $quotesQuery->get(),
            ]);
        }
        // Paginate quotes
        // $quotes = $quotesQuery->paginate(10); // Adjust page size as needed
        $quotes = $quotesQuery->paginate(10)->appends($request->query());


        $allCampaigns = Campaign::select('id', 'title')->get();

        return view('quote.index', [
            'campaign' => $campaign,
            'quotes' => $quotes,
            'allCampaigns' => $allCampaigns
        ]);
    }


    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'campaign_id'      => 'required|exists:campaigns,id',
        ]);
        // Step 4: Proceed with quote
        try {
            $formData = $request->except(['_token', 'campaign_id']);
            $status = 0;
            $quote = Quote::create([
                'campaign_id'      => $validated['campaign_id'],
                'form_data'     => json_encode($formData),
                'date'          => now()->toDateString(),
                'status'        => $status,
            ]);


            return redirect()->back()->with('success', 'Quote saved and email sent successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Quote failed: ' . $th->getMessage());
        }
    }

    // /**
    //  * Show the specified resource.
    //  */
    // public function show($id)
    // {
    //     $quote = Campaign::with('campaign')->findOrFail($id);
    //     $formData = json_decode($quote->form_data, true);

    //     return view('quote.show', [
    //         'quote' => $quote,
    //         'formData' => $formData,
    //     ]);
    // }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $quote = Quote::findOrFail($id);
            $quote->delete();
            return back()->with('success', 'Campaign Quote Deleted Successfully!');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function multiple_delete_now(Request $request)
    {
        try {
            foreach ($request->id as $key => $id) {
                $booking = Quote::find($id);
                $booking->delete();
            }
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function multiple_status_change_now(Request $request)
    {
        try {
            foreach ($request->id as $id) {
                $booking = Quote::find($id);
                if ($booking) {
                    // Toggle status: 1 → 0, 0 → 1
                    $booking->status = !$booking->status;
                    $booking->save();
                }
            }

            return response()->json(['success' => true, 'message' => 'Quote status toggled successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
