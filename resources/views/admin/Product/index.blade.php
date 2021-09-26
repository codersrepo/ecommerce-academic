@extends('layouts.admin ');
@section('title','product Listing Page| Admin Page')

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Product Listing Page

                        </div>
                        <a href="{{route('product.create')}}" class="btn btn-success float-right">
                            <i class="fa fa-plus"></i>Add product
                        </a>
                    </div>
                    <div class="ibox-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Summary</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Colour</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                             @if($data)
                                @foreach($data as $data_indiv)
                                                    {{-- @if($data_indiv->properties)
                                                    @foreach ($data_indiv->properties as $property)
                                                        <b>{{ $property['key'] }}</b>: {{ $property['value'] }}<br />
                                                    @endforeach
                                                    @endif  --}}

                                        <td>{{ $data_indiv->title }} </td>
                                        <td>{{ \Illuminate\Support\Str::limit($data_indiv->summary, 30) }} </td>
                                        <td>{{ $data_indiv->size }} </td>
                                        <td>{{ $data_indiv->price }} </td>
                                        <td>{{ $data_indiv->colour }} </td>
                                        <td> <img  style="max-width: 100px" src="{{ asset('images/product_images/icons/'.$data_indiv->image_icon) }}" alt="product_image"></td>
                                        {{-- <td> <video  style="max-width: 150px" src="{{ asset('videos/product_video/'.$data_indiv->video) }}" alt="product_video"></video></td> --}}
                                        {{-- <td><video style="max-width: 150px" width="100%" controls>
                                            <source src="{{ asset('videos/product_video/'.$data_indiv->video) }}" type="video/mp4">
                                       </video> </td> --}}
                                        {{-- @endif --}}
                                        <td>@if($data_indiv->status == 'active')
                                        <a class="updateProductStatus badge badge-success" id="product-{{ $data_indiv->id }}" product_id = {{ $data_indiv->id }} href="javascript:void(0)">
                                            Active </a>
                                            @else
                                            <a class="updateProductStatus badge badge-danger" id="product-{{ $data_indiv->id }}" product_id = {{ $data_indiv->id }}  href="javascript:void(0)">
                                                InActive </a>
                                       @endif
                                            </td>
                                        <td><a href="{{ route('product.edit',$data_indiv->id) }}" class="btn btn-primary btn-circle"> <i class="fa fa-edit  fa-sm"></i></a>
                                            {{-- <form action="{{ route('product.destroy',$data_indiv->id) }}" onsubmit = 'return confirm("are you sure you want to delete")' id="logout_form" method="post">
                                                @method('delete')
                                                @csrf
                                            <button type="submit" class='btn btn-danger btn-circle'> <i class="fa fa-trash"></i>  </button>
                                            </form> --}}

                                            <form action="{{ route('product.destroy',$data_indiv->id) }}" class='form float-left' onsubmit = 'return confirm("you sure? To delete this")' id="delete-form" method="post">
                                                @method('delete')
                                                @csrf
                                            <button type="submit" class='btn btn-danger btn-circle'> <i class="fa fa-trash"></i> </button>
                                        </form>
                                    </td>
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


@section('script')
<script>
$(".updateProductStatus").click(function(){
var status = $(this).text();
var product_id = $(this).attr("product_id");
$.ajax({
    type:'post',
    url:'{{ route("updateProductStatus") }}',
    data:{status:status, product_id:product_id,
        "_token": "{{ csrf_token() }}",
    },
    success:function(resp){
            if(resp['status'] == 'active'){
                $("#product-"+product_id).html("<a class='updateproductStatus badge badge-success' href='javascript:void(0)'>Active </a>");
            } else if(resp['status'] == 'inactive'){
                $("#product-"+product_id).html("<a class='updateproductStatus badge badge-danger' href='javascript:void(0)'>Inactive </a>");
            }
        },error:function(){
            alert("Error");
        }
    });
});

</script>
@endsection
