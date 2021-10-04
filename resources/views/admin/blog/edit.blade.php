@extends('layouts.admin ');
@section('title','blog Listing Page| Admin Page')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">blog List

                        </div>
                        <a href="{{route('blog.create')}}" class="btn btn-success float-right">
                            <i class="fa fa-plus"></i>Add blog
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
                                        @if($data_indiv->image)
                                        <td> <img  style="max-width: 150px" src="{{ asset('images/categories/'.$data_indiv->image) }}" alt="blog_image"></td>
                                        @endif
                                        <td>
                                            {{-- {{ dd($data_indiv->status) }} --}}
                                            @if($data_indiv->status == 'active')
                                                 <a class="updateblogStatus badge badge-success" id="blog-{{ $data_indiv->id }}" blog_id = {{ $data_indiv->id }} href="javascript:void(0)">
                                            Active </a>
                                            @else
                                            <a class="updateblogStatus badge badge-danger" id="blog-{{ $data_indiv->id }}" blog_id = {{ $data_indiv->id }}  href="javascript:void(0)">
                                               InActive </a>
                                                @endif
                                            </span></td>


                                        <td><a href="{{ route('blog.edit',$data_indiv->id) }}" class="btn btn-primary">Edit</a>
                                            <form action="{{ route('blog.destroy',$data_indiv->id) }}" class='form float-left ' onsubmit = 'return confirm("are you sure ou want to delete")' id="logout_form" method="post">
                                                @method('delete')
                                                @csrf
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        <a href="{{ route('blog.show',$data_indiv->id) }}" class="btn btn-warning">Show</a>
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


@section('script')
<script>
    $(".updateblogStatus").click(function(){
    var status = $(this).text();
    var blog_id = $(this).attr("blog_id");
    $.ajax({
        type:'post',
        url:'{{ route("updateStatus") }}',
        data:{status:status,blog_id:blog_id,
            "_token": "{{ csrf_token() }}",
        },
        success:function(resp){
            if(resp['status'] == 'active'){
                $("#blog-"+blog_id).html("<a class='updateblogStatus badge badge-success' href='javascript:void(0)'>Active </a>");
            } else if(resp['status'] == 'inactive'){
                $("#blog-"+blog_id).html("<a class='updateblogStatus badge badge-danger' href='javascript:void(0)'>Inactive </a>");
            }
        },error:function(){
            alert("Error");
        }
    });
    });
</script>
@endsection
