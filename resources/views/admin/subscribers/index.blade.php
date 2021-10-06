@extends('layouts.admin ');
@section('title','Blog Listing Page| Admin Page')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">{{ (__('trans.Subscriber List')) }}
                        </div>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                            <tr>
                                <th>{{ (__('trans.Email')) }}</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($data)
                                @foreach($data as $data_indiv)
                                    <tr>
                                        <td>{{ $data_indiv->email }} </td>
                                    </tr>
                                    @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection