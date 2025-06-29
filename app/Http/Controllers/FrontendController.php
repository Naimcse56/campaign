<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class FrontendController extends Controller
{
    public function campaign(Request $request)
    {
        try {
            // $shopId = Crypt::decrypt($request->query('shopId'));
            $shop = Shop::where('slug',$request->query('shop'))->first();
            $campaign = Campaign::with(['shop', 'formFields'])->where('shop_id', $shop->id)->where('is_active', 1)->first();

            $data['campaign'] = $campaign;
            $data['fields'] = @$campaign->formFields;
            return view('home', $data);
        } catch (\Throwable $th) {

            abort(404);
        }
    }
}
