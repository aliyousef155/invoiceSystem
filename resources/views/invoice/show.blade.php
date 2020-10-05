
@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{asset('frontend/pickdate/classic.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/pickdate/classic.date.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/pickdate/classic.time.css')}}">
    @if(LaravelLocalization::getCurrentLocale() == 'ar')
        <link rel="stylesheet" href="{{asset('frontend/pickdate/rtl.css')}}">

    @endif
    <style>
        form.form label.error, label.error {
            color: red;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="card" id="card">
            <div class="card-header d-flex justify-content-between">
                <h5># {{$invoice->invoice_number}}</h5>
                <strong>{{$invoice->invoice_date}}</strong>



            </div>
{{--            end of card header--}}
            <div class="card-body">
                <div class="row ">
                    <div class="col-md-12">
                        <h6 class="mb-3">{{__('site.to')}}</h6>
                        <div>
                            <strong>{{$invoice->customer_name}}</strong>
                        </div>
                            @if($invoice->customer_email!='')
                        <div>Email: {{$invoice->customer_email}}</div>
                        @endif
                        <div>Phone: {{$invoice->customer_mobile}}</div>
                    </div>

                </div>
{{--                end of row--}}

                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="center">#</th>
                            <th>{{__('site.product_name')}}</th>
                            <th>{{__('site.unit')}}</th>
                            <th class="right">{{__('site.unit_price')}}</th>
                            <th class="center">{{__('site.quantity')}}</th>
                            <th class="right">{{__('site.subtotal')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($invoice->details as $index=> $details)
                        <tr>
                            <td class="center">{{$index + 1}}</td>
                            <td class="right">{{$details->product_name}}</td>
                            <td class="left strong">{{$details->unit}}</td>
                            <td class="left">{{$details->unit_price}}</td>
                            <td class="right">{{$details->quantity}}</td>
                            <td class="center">{{$details->row_sub_total}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
{{--                end of table--}}
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-clear">
                            <tbody>
                            <tr class="">
                                <td class=" ">
                                    <strong>{{__('site.subtotal')}}</strong>
                                </td>
                                <td class="">{{$invoice->sub_total}}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>{{__('site.discount')}}</strong>
                                </td>
                                <td class="right">{{$invoice->discount_value}}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>{{__('site.vat')}}</strong>
                                </td>
                                <td class="right">{{$invoice->vat_value}}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>{{__('site.shipping')}} </strong>
                                </td>
                                <td class="right">{{$invoice->shipping}}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>{{__('site.total_due')}}</strong>
                                </td>
                                <td class="right">
                                    <strong>{{$invoice->total_due}}</strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
{{--                end of row--}}

            </div>
{{--            end of card body--}}

        </div>
{{--        end of card--}}
        <div class="d-flex justify-content-center mt-3">
            <button class="btn btn-primary " id="print" type="button">{{__('site.print')}}</button>
        </div>
        {{--            end of div--}}
    </div>
{{--    end of container--}}
@endsection
@section('script')
    <script>
       $(document).ready(function () {
           $(document).on('click','#print',function (e) {
               e.preventDefault();
               $('#card').printThis();
           });
       });
    </script>
@endsection

