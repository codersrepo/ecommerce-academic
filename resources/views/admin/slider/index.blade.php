@extends('layouts.admin ');
@section('title','Category Listing Page| Admin Page')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">{{ (__('trans.Slider List')) }}

                        </div>
                        <a href="{{route('slider.create')}}" class="btn btn-success float-right">
                            <i class="fa fa-plus"></i>{{ (__('trans.Add Slider')) }}
                        </a>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>{{ (__('trans.Title')) }}</th>
                                <th>{{ (__('trans.Summary')) }}</th>
                                <th>{{ (__('trans.Image')) }}</th>
                                <th>{{ (__('trans.Status')) }}</th>
                                <th>{{ (__('trans.Action')) }}</th>

                            </tr>
                            </thead>
                            <tbody>

                            @if($data)
                                @foreach($data as $data_indiv)
                                    <tr>
                                        <td>{{ $data_indiv->title }} </td>
                                        <td>{{ $data_indiv->summary }} </td>
                                        <td> <img  style="max-width: 150px" src="{{ asset('images/sliders/'.$data_indiv->image) }}" alt=""></td>
                                        <td> <span class="badge badge-{{ $data_indiv->status == 'active' ? 'success' : 'danger' }}">
                                            {{ ($data_indiv->status == 'active') ? 'Published' : 'Un-Published' }}
                                            </span></td>
                                        <td><a href="{{ route('slider.edit',$data_indiv->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('slider.destroy',$data_indiv->id) }}" class='form float-left' onsubmit = 'return confirm("you sure? To delete this")' id="logout_form" method="post">
                                                @method('delete')
                                                @csrf
                                            <button type="submit" class='btn btn-danger btn-circle'> <i class="fa fa-trash"></i> </button>
                                            </td>
                                            </form>
                                            @endforeach
                                    </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
