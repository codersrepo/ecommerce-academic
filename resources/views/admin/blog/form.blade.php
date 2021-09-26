@extends('layouts.admin')
@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">blog {{ isset($data) ? 'Update' : 'Add' }}
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form method="post" action="{{ route('blog.store') }}" enctype="multipart/form-data">
                            @csrf
                        <!-- <h3>for {{ app()->getlocale() }}</h1> -->
                            <div class="form-group">
                                <label for="">Title ({{strtoupper(app()->getlocale()) }})</label>
                                <input type="text" name="{{ app()->getlocale() }}[title]" class="form-control" aria-describedby="emailHelp" placeholder="Enter Text">
                                @error('title')
                                 <span class="alert-danger">{{$message}}  </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Summary ({{strtoupper(app()->getlocale()) }})</label>
                                <input type="text" name="{{ app()->getlocale() }}[summary]" class="form-control" aria-describedby="emailHelp" placeholder="Enter Text">
                                @error('summary')
                                <span class="alert-danger">{{$message}}  </span>
                               @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Description({{strtoupper(app()->getlocale()) }})</label>
                                <input type="text" name="{{ app()->getlocale() }}[description]" class="form-control" aria-describedby="emailHelp" placeholder="Enter Text">
                                @error('description')
                                <span class="alert-danger">{{$message}}  </span>
                               @enderror
                            </div>

                    <div class="form-group row">
                        {{ Form::label('image','Image',['class'=>'col-sm-3'])}}
                            <div class="col-sm-4">
                                {{Form::file('image',['id'=>'image','required'=>(isset($data) ? false : true)] ) }}
                                @error('image')
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
                        <div class="form-group row">
                            {{ Form::label('','',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::button('<i class="fa fa-trash"></i>Reset',['class'=>'btn btn-sm btn-danger', 'id'=>'reset','type'=>'reset'] ) }}
                                {{ Form::button('<i class="fa fa-paper-plane"></i>Submit',['class'=>'btn btn-sm btn-success', 'id'=>'submit','type'=>'submit'] ) }}
                            </div>

                        </div>
                        {{ Form::close()}}

                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
