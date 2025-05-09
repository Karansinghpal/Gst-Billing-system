<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;
use App\Models\GstBill;
use Illuminate\Support\Facades\DB;

class GSTBillController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    # Function to load gst bills
    public function index()
    {
        $bills = GstBill::where('is_deleted', 0)->with('party')->get();
        return view("gst-bill.index", compact('bills'));
    }

    # Function to load add gst bill view
    public function addGstBill()
    {
        // Debug: Log the number of parties being fetched
        $parties = Party::where('party_type', 'client')->orderBy('full_name')->get();
        \Log::info('Number of parties found: ' . $parties->count());
        
        // If no parties found, try fetching all parties without the type filter
        if ($parties->isEmpty()) {
            $parties = Party::orderBy('full_name')->get();
            \Log::info('Number of parties without type filter: ' . $parties->count());
        }
        
        return view("gst-bill.add", compact('parties'));
    }

    // Remove or comment out the create() method as it's conflicting with addGstBill()
    /*
    public function create()
    {
        // Try fetching from the clients table instead if that's what you're using
        $parties = \App\Models\Client::all();
        
        return view('gst-bill.add', compact('parties'));
    }
    */

    public function createGstBill(Request $request)
    {
        // Valildation
        $request->validate([
            'party_id' => 'required|exists:parties,id',
            'invoice_date' => 'required|date',
            'invoice_no' => 'required|string|max:255',
            'item_description' => 'required|max:250',
            'total_amount' => 'required|numeric',
            'cgst_rate' => 'nullable|min:0|max:100',
            'cgst_amount' => 'numeric|min:0',
            'sgst_rate' => 'nullable|min:0|max:100',
            'sgst_amount' => 'numeric|min:0',
            'igst_rate' => 'nullable|min:0|max:100',
            'igst_amount' => 'numeric|min:0',
            'tax_amount' => 'numeric|min:0',
            'net_amount' => 'required|numeric|min:0',
        ]);

        $param = $request->all();

        // Remove token from post data before inserting
        unset($param['_token']);
        GstBill::create($param);

        // Redirect to manage bills
        return redirect()->route('manage-gst-bills')->withStatus("Bill created successfully");
    }

    # Function to load print gst bill view
    public function print($id)
    {
        $data['bill'] = GstBill::where('id', $id)->with('party')->first();
        return view("gst-bill.print", $data);
    }
}
