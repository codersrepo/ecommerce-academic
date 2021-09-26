@extends('layouts.admin')
@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Product {{ isset($data) ? 'Update' : 'Add' }}
                        </div>
                    </div>
                    <div class="ibox-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12">
                                    <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                                        @csrf
                                         <!-- <h3>for {{ app()->getlocale() }}</h1> -->
                                        <div class="form-group row">
                                            <label style = "font-weight:700" class='col-sm-12 col-md-2' >Title ({{strtoupper(app()->getlocale()) }}) : </label>
                                            <div class="col-sm-12 col-md-9">
                                                <input type="text" name="{{ app()->getlocale() }}[title]" class="form-control" aria-describedby="emailHelp" placeholder="Enter Text">
                                                @error('title')
                                                <span class="alert-danger">{{$message}}  </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label style = "font-weight:700" class='col-sm-12 col-md-2' for="">Summary ({{strtoupper(app()->getlocale()) }})</label>
                                            <div class="col-sm-12 col-md-9">
                                                <input type="text" name="{{ app()->getlocale() }}[summary]" class="form-control" aria-describedby="emailHelp" placeholder="Enter Text">
                                                @error('summary')
                                                <span class="alert-danger">{{$message}}  </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label style = "font-weight:700" class='col-sm-12 col-md-2' for="">Description({{strtoupper(app()->getlocale()) }})</label>
                                            <div class="col-sm-12 col-md-9">
                                                <input type="text" name="{{ app()->getlocale() }}[description]" class="form-control" aria-describedby="emailHelp" placeholder="Enter Text">
                                                @error('description')
                                                <span class="alert-danger">{{$message}}  </span>
                                                @enderror
                                            </div>
                                        </div>

                                        {{-- {{ dd($product_data) }} --}}
                                        <div class="form-group row" style="margin-top:10px;">
                                            <label style = "font-weight:700" class='col-sm-12 col-md-2'>Select Category ({{strtoupper(app()->getlocale()) }})</label>
                                            <div class="col-sm-12 col-md-9">

                                                    <select class="form-control select2 select2-hidden-accessible" name="category_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                        @foreach($category_data as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                            </div>
                                       </div>

                                    <div class="row">
                                        <div class="col-sm">
                                            <div class="form-group row">
                                                <label style = "font-weight:700" for="">Price({{strtoupper(app()->getlocale()) }})</label>
                                                <input type="number" name="{{ app()->getlocale() }}[price]" class="form-control" aria-describedby="emailHelp" placeholder="Enter Text">
                                                @error('description')
                                                <span class="alert-danger">{{$message}}  </span>
                                                  @enderror
                                            </div>

                                            <div class="form-group row">
                                                <label style = "font-weight:700" for="">Discount % ({{strtoupper(app()->getlocale()) }})</label>
                                                <input type="number" name="{{ app()->getlocale() }}[discount_percent]" class="form-control" aria-describedby="emailHelp" placeholder="Enter Text">
                                                @error('description')
                                                <span class="alert-danger">{{$message}}  </span>
                                                @enderror
                                            </div>

                                            <div class="form-group row">
                                                <label style = "font-weight:700" for="">Brand Name({{strtoupper(app()->getlocale()) }})</label>
                                                <input type="text" name="{{ app()->getlocale() }}[brand_name]" class="form-control" aria-describedby="emailHelp" placeholder="Enter Text">
                                                @error('description')
                                                <span class="alert-danger">{{$message}}  </span>
                                                 @enderror
                                            </div>


                                            <div class="form-group row">
                                                {{ Form::label('images[]','Image',['class'=>'col-sm-3'])}}
                                                    <div class="col-sm-4">
                                                        {{Form::file('image_id[]',['id'=>'image_id[]','required'=>(isset($data) ? false : true),'accept'=>'image/*','multiple' => true] ) }}
                                                        @error('image_id')
                                                        <span class="alert-danger">{{$message}}  </span>
                                                        @enderror
                                                    </div>
                                            </div>


                                            <div class="form-group row">
                                                {{ Form::label('video','Video',['class'=>'col-sm-3'])}}
                                                    <div class="col-sm-4">
                                                        {{Form::file('video',['id'=>'video','accept'=>'video/*'] ) }}
                                                        @error('video')
                                                        <span class="alert-danger">{{$message}}  </span>
                                                        @enderror
                                                    </div>
                                            </div>



                                        </div>

                                        <div class="col-sm">
                                            <div class="form-group row">
                                                <label style = "font-weight:700" for="">Product Colour({{strtoupper(app()->getlocale()) }})</label>
                                                <select name="colour" class="js-select2" name="time">
                                                    <option value="">Choose an option</option>
                                                    <option value="red">Red</option>
                                                    <option value="blue">Blue</option>
                                                    <option value="white">White</option>
                                                    <option value="grey">Grey</option>
                                                </select>
                                            </div>

                                            <div class="form-group row">
                                                <label style = "font-weight:700" for="">Product Code({{strtoupper(app()->getlocale()) }})</label>
                                                <input type="text" name="product_code" class="form-control" aria-describedby="emailHelp" placeholder="Enter Text">
                                                @error('description')
                                                <span class="alert-danger">{{$message}}  </span>
                                            @enderror
                                            </div>

                                            <div class="form-group row">
                                                <label style = "font-weight:700" for="">Size({{strtoupper(app()->getlocale()) }})</label>
                                                <select name="size" class="js-select2">
                                                    <option value="">Choose an option</option>
                                                    <option value="S">Size S</option>
                                                    <option value="M">Size M</option>
                                                    <option value="L">Size L</option>
                                                    <option value="XL">Size XL</option>
                                                </select>
                                            </div>

                                            <div class="form-group row">
                                                {{ Form::label('image_icon','Image Icon',['class'=>'col-sm-3'])}}
                                                    <div class="col-sm-4">
                                                        {{Form::file('image_icon',['id'=>'image_icon','required'=>(isset($data) ? false : true),'accept'=>'image/*'] ) }}
                                                        @error('image_icon')
                                                        <span class="alert-danger">{{$message}}  </span>
                                                        @enderror
                                                    </div>
                                            </div>

                                            <div class="form-group row">
                                                {{ Form::label('status','Status',['class'=>'col-sm-3'])}}
                                                <div class="col-sm-9">
                                                    {{Form::select('status',['active'=> 'Published','inactive'=>'Unpublished'],@$data->status,['class'=>'form-control form-control-sm','id'=>'status','required'=>true])}}
                                                    @error('status')
                                                    <span class="alert-danger">{{$message}}  </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                {{-- <div class="form-group row">
                                    <label style = "font-weight:700" for="properties">Properties</label>
                                    <div class="row">
                                        <div class="col-md-2">
                                            Key:
                                        </div>
                                        <div class="col-md-4">
                                            Value:
                                        </div>
                                    </div>
                                    @for ($i=0; $i <= 4; $i++)
                                    <div class="row">
                                    <div class="col-md-2">
                                            <input type="text" name="properties[{{ $i }}][key]" class="form-control" value="{{ old('properties['.$i.'][key]') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="properties[{{ $i }}][value]" class="form-control" value="{{ old('properties['.$i.'][value]') }}">
                                        </div>
                                    </div>
                                    @endfor
                                </div>
                                <div> --}}



                                <div class="form-group row">
                                        {{ Form::label('','',['class'=>'col-sm-3'])}}
                                        <div class="col-sm-9">
                                            {{ Form::button('<i class="fa fa-trash"></i>Reset',['class'=>'btn btn-sm btn-danger', 'id'=>'reset','type'=>'reset'] ) }}
                                            {{ Form::button('<i class="fa fa-paper-plane"></i>Submit',['class'=>'btn btn-sm btn-success', 'id'=>'submit','type'=>'submit'] ) }}
                                        </div>

                                    </div>
                                    {{ Form::close()}}
                                </div></div></div>

                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
