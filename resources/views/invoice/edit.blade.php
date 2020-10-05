
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
    <div class="container ">
       <div class="row justify-content-center">
           <div class="col-md-12">
               <div class="card">
                   <div class="card-header">
                       <h5>{{__('site.create_invoice')}}</h5>
                   </div>
{{--                   end of card header--}}
                   <div class="card-body">
                       <form action="{{route('invoice.update',$invoice->id)}}" method="post">
                           @csrf
                           {{method_field('put')}}
                           <div class="row">
                               <div class="col-md-4 ">
                                   <div class="form-group">
                                       <label for="">{{__('site.customer_name')}}</label>
                                       <input type="text" name="customer_name" class="form-control" value="{{$invoice->customer_name}}">
                                       @error('customer_name') <span class="help-block text-danger">{{$message}}</span>@enderror
                                   </div>
                               </div>
{{--                               end of col-4--}}
                               <div class="col-md-4 ">
                                   <div class="form-group">
                                       <label for="">{{__('site.customer_email')}}</label>
                                       <input type="text" name="customer_email" class="form-control" value="{{$invoice->customer_email}}">
                                       @error('customer_email') <span class="help-block text-danger">{{$message}}</span>@enderror
                                   </div>
                               </div>
{{--                               end of col-4--}}
                               <div class="col-md-4 ">
                                   <div class="form-group">
                                       <label for="">{{__('site.customer_phone_number')}}</label>
                                       <input type="number" name="customer_mobile" class="form-control" value="{{$invoice->customer_mobile}}">
                                       @error('customer_phone_number') <span class="help-block text-danger">{{$message}}</span>@enderror
                                   </div>
                               </div>
{{--                               end of col-4--}}
                           </div>
{{--                           end of row--}}
                           <div class="row">

 {{--                               end of col-4--}}
                               <div class="col-md-4 ">
                                   <div class="form-group">
                                       <label for="">{{__('site.invoice_date')}}</label>
                                       <input type="text" name="invoice_date" class="form-control pickdate" value="{{$invoice->invoice_date}}">
                                       @error('invoice_date') <span class="help-block text-danger">{{$message}}</span>@enderror
                                   </div>
                               </div>
{{--                               end of col-4--}}
                               <div class="col-md-8 ">
                                   <div class="form-group">
                                       <label for="">{{__('site.description')}}</label>
                                       <textarea type="text" name="description" class="form-control"value="{{$invoice->description}}"></textarea>
                                       @error('description') <span class="help-block text-danger">{{$message}}</span>@enderror
                                   </div>
                               </div>
                           </div>
 {{--                           end of row--}}
                           <div class="table-responsive">
                               <table class="table" id="invoice_details">
                                   <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>{{__('site.product_name')}}</th>
                                       <th>{{__('site.unit')}}</th>
                                       <th>{{__('site.quantity')}}</th>
                                       <th>{{__('site.unit_price')}}</th>
                                       <th>{{__('site.subtotal')}}</th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                   @foreach($invoice->details as $index=> $details)
                                   <tr class="cloning_row" id="{{$index}}">
                                       <td>#</td>
                                       <td><input type="text" name="product_name[{{$index}}]"  class="product_name form-control" value="{{$details->product_name}}"></td>
                                        @error('product_name') <span class="help-block text-danger">{{$message}}</span>@enderror

                                            <td>       <select name="unit[{{$index}}]"  class="unit form-control" >
                                                    <option value="">#</option>
                                                    <option value="pace" {{$details->unit == 'pace'? 'selected':''}}>{{__('site.pace')}}</option>
                                                    <option value="g" {{$details->unit=='g' ? 'selected':''}}>{{__('site.gram')}}</option>
                                                    <option value="kg" {{$details->unit== 'kg'? 'selected':''}}>{{__('site.kilo_gram')}}</option>
                                                </select></td>
                                         @error('unit') <span class="help-block text-danger">{{$message}}</span>@enderror

                                       <td><input type="number" step="0.01" name="quantity[{{$index}}]"  class="quantity form-control" value="{{$details->quantity}}"></td>
                                        @error('quantity') <span class="help-block text-danger">{{$message}}</span>@enderror

                                       <td><input type="number" step="0.01" name="unit_price[{{$index}}]"  class="unit_price form-control" value="{{$details->unit_price}}"></td>
                                       @error('unit_price') <span class="help-block text-danger">{{$message}}</span>@enderror

                                       <td><input type="number" step="0.01" name="row_sub_total[{{$index}}]"  class="row_sub_total form-control" readonly="readonly" value="{{$details->row_sub_total}}"></td>
                                        @error('subtotal') <span class="help-block text-danger">{{$message}}</span>@enderror

                                   </tr>
                                   @endforeach
                                   </tbody>
                                   <tfoot>

                                        <tr>
                                            <td colspan="6">
                                                <button type="button" class="btn_add btn btn-primary">{{__('site.add_another_product')}}</button>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">{{__('site.subtotal')}}</td>
                                            <td ><input type="number" step="0.01" name="sub_total" id="sub_total" class="sub_total form-control" readonly="readonly" value="{{$invoice->sub_total}}"></td>
                                        </tr>


                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">{{__('site.discount')}}</td>
                                            <td >
                                                <div class="input-group mb-3">
                                                    <select name="discount_type" id="discount_type" class="discount_type custom-select" value="{{$invoice->discount_type}}">
                                                        <option value="fixed">EG</option>
                                                        <option value="percentage">{{__('site.percentage')}}</option>
                                                    </select>
                                                    <div class="input-group-append">
                                                        <input type="number" name="discount_value" id="discount_value" class="discount_value form-control" value="{{$invoice->discount_value}}" step="0.01">
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">{{__('site.vat')}}(5%)</td>
                                            <td ><input type="number" step="0.01" name="vat_value" id="vat_value" class="vat_value form-control" readonly="readonly" value="{{$invoice->vat_value}}"></td>
                                        </tr>


                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">{{__('site.shipping')}}</td>
                                            <td ><input type="number" step="0.01" name="shipping" id="shipping" class="shipping form-control" value="{{$invoice->shipping}}" ></td>
                                        </tr>


                                        <tr>
                                            <td colspan="3"></td>
                                            <td colspan="2">{{__('site.total_due')}}</td>
                                            <td ><input type="number" step="0.01" name="total_due" id="total_due" class="total_due form-control" readonly="readonly" value="{{$invoice->total_due}}"></td>
                                        </tr>



                                   </tfoot>
                               </table>
{{--                               end of table--}}
                           </div>
                                <div class="text-right pt-3">
                                    <button type="submit" name="save" class="btn btn-primary">{{__('site.save')}}</button>
                                </div>
                       </form>
{{--                       end of form--}}
                   </div>
{{--                   end of card body--}}
               </div>
{{--               end of card--}}
           </div>
{{--           end of col--}}
       </div>
{{--        end of row--}}
    </div>
{{--    end of container--}}
@endsection
@section('script')
    <script src="{{asset('frontend/validation/additional-methods.js')}}"></script>
    <script src="{{asset('frontend/validation/jquery.form.js')}}"></script>
    <script src="{{asset('frontend/validation/jquery.validate.min.js')}}"></script>


    <script src="{{asset('frontend/pickdate/picker.js')}}"></script>
    <script src="{{asset('frontend/pickdate/picker.date.js')}}"></script>
    <script src="{{asset('frontend/pickdate/picker.time.js')}}"></script>

    @if(LaravelLocalization::getCurrentLocale() == 'ar')
        <script src="{{asset('frontend/validation/messages_ar.js')}}"></script>

        <script src="{{asset('frontend/pickdate/ar.js')}}"></script>
    @endif
<script>
    $(document).ready(function () {


        $('.pickdate').pickadate({
           format:'yy-mm-dd',
           selectMonth: true,
           selectYear: true,
           clear:'clear',
           close:'ok',
           closeOnSelect:true,
        });// end of pickdate

          $('#invoice_details').on('keyup blur','.quantity',function () {
        let $row=$(this).closest('tr');
        let quantity=$row.find('.quantity').val()||0;
        let unit_price=$row.find('.unit_price').val()||0;
        $row.find('.row_sub_total').val((quantity*unit_price).toFixed(2));
        $('#sub_total').val(sum_total('.row_sub_total'));
        $('#vat_value').val(calculate_vat());
        $('#total_due').val(sum_due_total());

    });//end of counting from quantity

        $('#invoice_details').on('keyup blur','.unit_price',function () {
            let $row=$(this).closest('tr');
            let quantity=$row.find('.quantity').val()||0;
            let unit_price=$row.find('.unit_price').val()||0;
            $row.find('.row_sub_total').val((quantity*unit_price).toFixed(2));
            $('#sub_total').val(sum_total('.row_sub_total'));
            $('#vat_value').val(calculate_vat());
            $('#total_due').val(sum_due_total());

        });//end of counting from unit price

        $('#discount_value').on('keyup blur',function () {

            $('#vat_value').val(calculate_vat());
            $('#total_due').val(sum_due_total());
        });//end of counting discount value

           $('#discount_type').on('keyup blur',function () {

              $('#vat_value').val(calculate_vat());
              $('#total_due').val(sum_due_total());
        });//end of discount type

           $('#shipping').on('keyup blur',function () {
               $('#vat_value').val(calculate_vat());
               $('#total_due').val(sum_due_total());

        });//end of counting from quantity

        let  sum_total=function ($selector) {
        let sum=0;
             $($selector).each(function () {
          let selectorVal=$(this).val() != ''? $(this).val() :0;
          sum +=parseFloat(selectorVal);
      })
        return sum.toFixed(2)
        }//end of sum total

        let calculate_vat=function(){
            let sub_totalVal=$('.sub_total').val()||0;
            let discount_type=$('.discount_type').val()||0;
            let discount_value=parseFloat($('.discount_value').val())||0;
            let discountVal=discount_value !=0 ? discount_type=='percentage'? sub_totalVal*(discount_value/100 ): discount_value:0;
            let vatVal=(sub_totalVal - discountVal) * 0.05;
            return vatVal.toFixed(2)
        }// end of calculate vat

        let sum_due_total=function () {
            let sum = 0;
            let sub_totalVal=$('.sub_total').val()||0;
            let discount_type=$('.discount_type').val()||0;
            let discount_value=$('.discount_value').val()||0;
            let discountVal=discount_value !=0 ? discount_type=='percentage'? sub_totalVal*(discount_value/100 ): discount_value:0;
            let vatVal=parseFloat($('.vat_value').val())||0;
            let shippingVal=parseFloat($('.shipping').val())||0;

             sum+=sub_totalVal;
             sum-=discountVal;
             sum+=vatVal;
             sum+=shippingVal;
             return sum.toFixed(2);
        }//end of sum due total

        $(document).on('click','.btn_add',function () {
                let  trCount=$('#invoice_details').find('tr.cloning_row:last').length;
                let numberIncr=trCount>0 ? parseInt($('#invoice_details').find('tr.cloning_row:last').attr('id'))+1 :0;

                $('#invoice_details').find('tbody').append(`
                             <tr class="cloning_row" id="${numberIncr}">
                                   <td><button type='button' class='btn btn-danger btn-sm delgeted-btn'><i class='fa fa-minus'></i></button></td>
                                    <td><input type="text" name="product_name[${numberIncr}]"  class="product_name form-control"></td>
                                      <td>       <select name="unit[${numberIncr}]" id="unit" class="unit form-control">
                                           <option value="">#</option>
                                             <option value="pace">{{__('site.pace')}}</option>
                                              <option value="g">{{__('site.gram')}}</option>
                                              <option value="kg">{{__('site.kilo_gram')}}</option>
                                             </select></td>
                                         <td><input type="number" step="0.01" name="quantity[${numberIncr}]"  class="quantity form-control"></td>
                                          <td><input type="number" step="0.01" name="unit_price[${numberIncr}]"  class="unit_price form-control"></td>
                                        <td><input type="number" step="0.01" name="row_sub_total[${numberIncr}]"  class="row_sub_total form-control" readonly="readonly"></td>
                </tr>

`);
        }); // end of cloning

        $(document).on('click','.delgeted-btn',function (e) {
            e.preventDefault();
            $(this).parent().parent().remove();
            $('#sub_total').val(sum_total('.row_sub_total'));
            $('#vat_value').val(calculate_vat());
            $('#total_due').val(sum_due_total());
        });//end of delete btn

        $('form').on('submit',function (e) {
            $('input.product_name').each(function () {$(this).rules('add',{required:true});});
            $('input.unit').each(function () {$(this).rules('add',{required:true});});
            $('input.quantity').each(function () {$(this).rules('add',{required:true});});
            $('input.unit_price').each(function () {$(this).rules('add',{required:true});});
            $('input.row_sub_total').each(function () {$(this).rules('add',{required:true});});
        e.preventDefault();
        })

        $('form').validate({
            rules:{
                'customer_name':{required:true},
                'customer_email':{email:true},
                'customer_mobile':{required:true,digits:true,minlength:10,maxlength:14},
                'invoice_date':{required:true,},
            },
            submitHandler:function (form) {
            form.submit();
            }
        })//end of validate

    });//end of ready function


</script>
@endsection
