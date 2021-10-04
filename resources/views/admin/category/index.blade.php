@extends('layouts.admin ');
@section('title','Category Listing Page| Admin Page')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">{{ (__('trans.Category List')) }}

                        </div>
                        <a href="{{route('category.create')}}" class="btn btn-success float-right">
                            <i class="fa fa-plus"></i>{{ (__('trans.Add Category')) }}
                        </a>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
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
                                        <td>{{ $data_indiv->firstTranslation()->title }} </td>
                                        <td>{{ $data_indiv->firstTranslation()->summary }} </td>
                                        @if($data_indiv->image)
                                        <td> <img  style="max-width: 150px" src="{{ asset('images/categories/'.$data_indiv->image) }}" alt="Category_image"></td>
                                        @endif
                                        <td>
                                            {{-- {{ dd($data_indiv->status) }} --}}
                                            @if($data_indiv->status == 'active')
                                                 <a class="updateCategoryStatus badge badge-success" id="category-{{ $data_indiv->id }}" category_id = {{ $data_indiv->id }} href="javascript:void(0)">
                                            Active </a>
                                            @else
                                            <a class="updateCategoryStatus badge badge-danger" id="category-{{ $data_indiv->id }}" category_id = {{ $data_indiv->id }}  href="javascript:void(0)">
                                               InActive </a>
                                                @endif
                                            </span></td>


                                        <td><a href="{{ route('category.edit',$data_indiv->id) }}">Edit</a>
                                            <form action="{{ route('category.destroy',$data_indiv->id) }}" class='form float-left' onsubmit = 'return confirm("you sure? To delete this")' id="delete-form" method="post">
                                                @method('delete')
                                                @csrf
                                            <button type="submit" class='btn btn-danger btn-circle'> <i class="fa fa-trash"></i> </button>
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


@section('script')
<script>
    $(".updateCategoryStatus").click(function(){
    var status = $(this).text();
    var category_id = $(this).attr("category_id");
    $.ajax({
        type:'post',
        url:'{{ route("updateCategoryStatus") }}',
        data:{status:status,category_id:category_id,
            "_token": "{{ csrf_token() }}",
        },
        success:function(resp){
            if(resp['status'] == 'active'){
                $("#category-"+category_id).html("<a class='updateCategoryStatus badge badge-success' href='javascript:void(0)'>Active </a>");
            } else if(resp['status'] == 'inactive'){
                $("#category-"+category_id).html("<a class='updateCategoryStatus badge badge-danger' href='javascript:void(0)'>Inactive </a>");
            }
        },error:function(){
            alert("Error");
        }
    });
    });
</script>
@endsection
