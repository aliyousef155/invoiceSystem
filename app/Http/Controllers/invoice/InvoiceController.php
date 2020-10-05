<?php

namespace App\Http\Controllers\invoice;

use App\Http\Controllers\Controller;
use App\models\invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices=invoice::latest()->paginate(5);
        return view('invoice.index',compact('invoices'));
    }//end of index


    public function create()
    {
        return view('invoice.create');
    }//end of create


    public function store(Request $request)
    {
        $data=[
            'customer_name'=> $request->customer_name,
            'customer_email'=> $request->customer_email,
            'customer_mobile'=> $request->customer_mobile,
            'description'=> $request->description,
            'invoice_date'=> $request->invoice_date,
            'sub_total'=> $request->sub_total,
            'discount_value'=> $request->discount_value,
            'vat_value'=> $request->vat_value,
            'shipping'=> $request->shipping,
            'total_due'=> $request->total_due,
        ];
        $details_list=[];
        for ($i=0;$i<count($request->product_name);$i++){
            $details_list[$i]['product_name']=$request->product_name[$i];
            $details_list[$i]['unit']=$request->unit[$i];
            $details_list[$i]['quantity']=$request->quantity[$i];
            $details_list[$i]['unit_price']=$request->unit_price[$i];
            $details_list[$i]['row_sub_total']=$request->row_sub_total[$i];

        }

        $data['invoice_number']=random_int(1,100000);
        $invoice=   invoice::create($data);

        $details=$invoice->details()->createMany($details_list);

        session()->flash('success',__('site.invoice_added_successfully'));
        return redirect()->route('invoice.index');

    }//end of store


    public function show(invoice $invoice)
    {
        return view('invoice.show',compact('invoice'));
    }//end of show

    public function edit(invoice $invoice)
    {
        return view('invoice.edit',compact('invoice'));
    }//end of edit


    public function update(Request $request, invoice $invoice)
    {
        $invoice->delete();
        $data=[
            'customer_name'=> $request->customer_name,
            'customer_email'=> $request->customer_email,
            'customer_mobile'=> $request->customer_mobile,
            'description'=> $request->description,
            'invoice_date'=> $request->invoice_date,
            'sub_total'=> $request->sub_total,
            'discount_value'=> $request->discount_value,
            'vat_value'=> $request->vat_value,
            'shipping'=> $request->shipping,
            'total_due'=> $request->total_due,
        ];
        $details_list=[];
        for ($i=0;$i<count($request->product_name);$i++){
            $details_list[$i]['product_name']=$request->product_name[$i];
            $details_list[$i]['unit']=$request->unit[$i];
            $details_list[$i]['quantity']=$request->quantity[$i];
            $details_list[$i]['unit_price']=$request->unit_price[$i];
            $details_list[$i]['row_sub_total']=$request->row_sub_total[$i];

        }
        $data['invoice_number']=$invoice->invoice_number;
        $invoice_data= invoice::create($data);

        $details=$invoice_data->details()->createMany($details_list);
        session()->flash('success',__('site.invoice_edited_successfully'));
        return redirect()->route('invoice.index');

    }//end of update


    public function destroy(invoice $invoice)
    {
        $invoice->delete();
        session()->flash('success',__('site.invoice_deleted_successfully'));
        return redirect()->route('invoice.index');
    }//end of destroy

}//end of controller
