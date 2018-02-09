<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Customer;
use App\Models\TransactionList;
use App\Models\GeneralLedgerTransactions;
use Illuminate\Http\Request;
// use App\Http\Controllers\LedgerController;

// class InvoiceController extends Controller
class InvoiceController extends LedgerController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = Invoice::orderBy('id', 'DESC')->paginate(20);
        // $invoices = array_reverse($invoices);
        return view('pages.invoice.index')->with('invoices', $invoices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $name = $request->input('name');
            $id = $request->input('customer_id');
            $company = $request->input('company');
            $email = $request->input('email');
            $address = $request->input('address');
            $order_id = $request->input('order_id');
            $amount = $request->input('amount');
            $due_date = $request->input('due_date');
            // $phone = $request->input('phone');
            $description = $request->input('description');


            $invoice = new Invoice;
            $invoice->name = $name;
            $invoice->customer_id = $id;
            $invoice->company = $company;
            $invoice->email = $email;
            $invoice->address = $address;
            $invoice->order_id = $order_id;
            $invoice->amount = $amount;
            $invoice->due_date = $due_date;
            // $invoice->phone_number = 
            $invoice->description = $description;

            $invoice->save();
            $invoice_id = Invoice::orderBy('id', 'DESC')->first()['id'];

            $more_args = array(
                'repeat'        => False,
                'invoice_id'    => $invoice_id
            );
            // print_r($invoice);
            $today = date("m-d-Y H:i:sa");
            $lol = $this->addNewEntry($today, $description, 'Accounts Receivable', $amount, 'Debit', 'Debit', 'Asset', $more_args);

            $more_args['repeat'] = True;
            $this->addNewEntry($today, $description, 'Revenues', $amount, 'Credit', 'Credit', 'Revenue', $more_args);

            $message = 'Successfully entered in an Invoice';
        }
        catch(\Exception $e) {
            $message = $e->getMessage();
        }
        return redirect()->back()->with('feedback', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $invoice = Invoice::find($id);
        return view('pages.invoice.show')->with('invoice', $invoice);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $invoice = Invoice::find($id);

        return view('pages.invoice.edit')->with('invoice', $invoice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            Invoice::find($id)->update($request->all());
            $message = 'Edit successful';
        }
        catch (\Exception $e) {
            $message = $e->getMessage();
        }
        
        return redirect('/invoice')->with('feedback', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $invoice = Invoice::find($id);

            $invoice_array = $invoice->toArray();
            $invoice_id = $invoice_array['id'];
            $invoice_name = $invoice_array['name'];

            $transaction = TransactionList::where('invoice_id', $invoice_id)->first();
            $tx = $transaction->toArray();
            $tx_id = $tx['id'];
            
            $ledger_entry = GeneralLedgerTransactions::where('tx_id', $tx_id)->delete();

            $invoice->delete();
            $transaction->delete();
            $message = "Deleted " . $invoice_name . "(ID: " . $invoice_id . ")";
        }
        catch (\Exception $e) {
            $message = $e->getMessage();
        }

        return redirect()->back()->with('feedback', $message);
    }

    public function togglePaid($id)
    {
        try {
            $invoice = Invoice::find($id);
            $invoice_array = $invoice->toArray();

            if($invoice_array['paid'] === 0) {
                $invoice['paid'] = 1;

                $amount = $invoice['amount'];
                // $due_date = $invoice['due_date'];
                // $phone = $invoice['phone'];
                $description = $invoice['description'] . "(cash paid)";

                $more_args = array(
                'repeat'        => False,
                'invoice_id'    => $id
                );
                
                $today = date("m-d-Y H:i:sa");
                $lol = $this->addNewEntry($today, $description, 'Cash', $amount, 'Debit', 'Debit ', 'Asset', $more_args);
    
                $more_args['repeat'] = True;
                $this->addNewEntry($today, $description, 'Accounts Receivable', $amount, 'Credit', 'Debit', 'Asset', $more_args);

                $message = 'Successfully marked paid';
            }
            else {
                $invoice['paid'] = 0;
                $message = 'Successfully marked unpaid';
            }
            $invoice->save();
        }
        catch (\Exception $e) {
            $message = $e->getMessage();
        }
        return redirect()->back()->with('feedback', $message);
    }
}
