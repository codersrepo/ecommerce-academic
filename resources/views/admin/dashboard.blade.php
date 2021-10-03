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
                                <div class="ibox-title">Latest Orders</div>
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
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th width="91px">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="invoice.html">AT2584</a>
                                            </td>
                                            <td>@Jack</td>
                                            <td>$564.00</td>
                                            <td>
                                                <span class="badge badge-success">Shipped</span>
                                            </td>
                                            <td>10/07/2017</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice.html">AT2575</a>
                                            </td>
                                            <td>@Amalia</td>
                                            <td>$220.60</td>
                                            <td>
                                                <span class="badge badge-success">Shipped</span>
                                            </td>
                                            <td>10/07/2017</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice.html">AT1204</a>
                                            </td>
                                            <td>@Emma</td>
                                            <td>$760.00</td>
                                            <td>
                                                <span class="badge badge-default">Pending</span>
                                            </td>
                                            <td>10/07/2017</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice.html">AT7578</a>
                                            </td>
                                            <td>@James</td>
                                            <td>$87.60</td>
                                            <td>
                                                <span class="badge badge-warning">Expired</span>
                                            </td>
                                            <td>10/07/2017</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice.html">AT0158</a>
                                            </td>
                                            <td>@Ava</td>
                                            <td>$430.50</td>
                                            <td>
                                                <span class="badge badge-default">Pending</span>
                                            </td>
                                            <td>10/07/2017</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="invoice.html">AT0127</a>
                                            </td>
                                            <td>@Noah</td>
                                            <td>$64.00</td>
                                            <td>
                                                <span class="badge badge-success">Shipped</span>
                                            </td>
                                            <td>10/07/2017</td>
                                        </tr>
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
