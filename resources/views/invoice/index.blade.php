
@extends('layouts.app')

@section('content')
    <div class="container ">
        @if(Session::has('success'))
        <div class="row">
            <div class="col-md-6">
                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                        <p>{{session('success')}}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

            </div>
{{--            end of col--}}
        </div>
{{--            end of row--}}
        @endif
        <div class="row">
            <div class="col-md-12 ">
                <div class="card">
                    <div class="card-header d-flex justify-content-between ">
                        <h3>{{__('site.all_invoices')}}</h3>
                        <a href="{{route('invoice.create')}}" class=" btn btn-primary"><i class="fa fa-plus"> {{__('site.add_new_invoice')}}</i></a>
                    </div>
{{--                    end of card header--}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table " {{ LaravelLocalization::getCurrentLocale() == 'ar' ? ' style=direction:rtl  ':'' }}>
                                <thead >
                                <tr>
                                    <th>{{__("site.customer_name")}}</th>
                                    <th>{{__("site.invoice_date")}}</th>
                                    <th>{{__("site.total_due")}}</th>
                                    <th>{{__("site.actions")}}</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invoices as $invoice)
                                <tr>
                                    <td><a href="{{route('invoice.show',$invoice->id)}}">{{$invoice->customer_name}}</a></td>
                                    <td>{{$invoice->invoice_date}}</td>
                                    <td>{{$invoice->total_due}}</td>
                                    <td class="d-flex">
                                        <a href="{{route('invoice.edit',$invoice->id)}}" class="btn btn-primary btn-sm ml-1 mr-1"><i class="fa fa-edit"></i> {{__('site.edit')}}</a>
                                        <a href="javascript:void(0)" onclick="if(confirm('{{__('site.are_you_sure')}}')){document.getElementById('delete-{{$invoice->id}}').submit();} else{return false;}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{__('site.delete')}}</a>
                                        <form action="{{route('invoice.destroy',$invoice->id)}}" id="delete-{{$invoice->id}}" method="post">
                                            @csrf
                                            {{method_field('delete')}}
{{--                                            <button type="submit"  class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> {{__('site.delete')}}</button>--}}

                                        </form>
{{--                                        end of form--}}

                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{--                                end of table--}}
                        </div>
                        {{--                           end of table class--}}
                    </div>
 {{--                        end of card body--}}
                    {{$invoices->appends(request()->query())->links()}}
                </div>
{{--                end of card--}}

            </div>
{{--                      end of col--}}
        </div>
{{--                 end of row--}}
    </div>
    {{--        end of container --}}
@endsection
