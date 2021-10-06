@extends('layouts.admin')
@section('title','Admin Dashboard')
{{-- @section('styles')
<link rel="stylesheet" href="">
@endsection --}}
@section('content')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">{{ (__('trans.Latest Orders')) }}</div>
                                <div class="ibox-tools">
                                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item">option 1</a>
                                        <a class="dropdown-item">option 2</a>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>{{ (__('trans.Product Code')) }}</th>
                                            <th>{{ (__('trans.Customer Email')) }}</th>
                                            <th>{{ (__('trans.Location')) }}</th>
                                            <th>{{ (__('trans.Status')) }}</th>
                                            <th width="91px">{{ (__('trans.Date')) }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                        <tr>
                                            <td>
                                                <a href="{{ route('front.shop.show',$order->cart->product->slug) }}"> {{ $order->cart->product->product_code }}</a>
                                            </td>
                                            <td>{{ $order->user->email }}</td>
                                            <td>{{ $order->address }}</td>
                                            <td>
                                            @if($order->status == 'new')
                                                 <a class="updateOrderStatus badge badge-success" id="order-{{ $order->id }}" order_id = {{ $order->id }} href="javascript:void(0)">
                                            New </a>
                                            @else
                                            <a class="updateOrderStatus badge badge-danger" id="order-{{ $order->id }}" order_id = {{ $order->id }}  href="javascript:void(0)">
                                               Delivered </a>
                                                @endif
                                            </span></td>

                                                <!-- <span class="badge badge-success">{{ $order->status }}</</span> -->
                                            <!-- </td> -->
                                            <td>{{ $order->created_at ->toDateString()}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


@section('scripts')
<style>
.visitors-table tbody tr td:last-child {
                display: flex;
                align-items: center;
            }

            .visitors-table .progress {
                flex: 1;
            }

            .visitors-table .progress-parcent {
                text-align: right;
                margin-left: 10px;
            }
        </style>

        @endsection

    <!-- END PAGE CONTENT-->
    <footer class="page-footer">
        <div class="font-13">2021 - {{ date('Y') }} <b>AdminCAST</b> - All rights reserved.</div>
        <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
    </footer>
</div>


@endsection

@section('script')
<script>
    $(".updateOrderStatus").click(function(){
    var status = $(this).text();
    var order_id = $(this).attr("order_id");
    $.ajax({
        type:'post',
        url:'{{ route("front.updateOrderStatus") }}',
        data:{status:status,order_id:order_id,
            "_token": "{{ csrf_token() }}",
        },
        success:function(resp){
            if(resp['status'] == 'new'){
                $("#order-"+order_id).html("<a class='updateOrderStatus badge badge-success' href='javascript:void(0)'>New </a>");
            } else if(resp['status'] == 'delivered'){
                $("#order-"+order_id).html("<a class='updateOrderStatus badge badge-danger' href='javascript:void(0)'>Delivered </a>");
            }
        },error:function(){
            alert("Error");
        }
    });
    });
</script>
@endsection

