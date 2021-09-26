@extends('layouts.admin')
@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Slider {{ isset($data) ? 'Update' : 'Add' }}
                        </div>
                    </div>
                    <div class="ibox-body">
                        <form method="post" action="{{ route('slider.store') }}", enctype='multipart/form-data'>
                            @csrf
                                <input type="hidden" name="lang" value="{{ app()->getlocale() }}">
                            <div class="form-group">
                                <label for="">Title ({{app()->getlocale()}})</label>
                                <input type="text" name="{{ app()->getlocale() }}[title]" class="form-control" aria-describedby="emailHelp" placeholder="Enter Text">
                            </div>
                            <div class="form-group">
                                <label for="">Summary ({{strtoupper(app()->getlocale()) }})</label>
                                <input type="text" name="{{app()->getlocale()  }}[summary]" class="form-control" aria-describedby="emailHelp" placeholder="Enter Text">
                            </div>

                            <div class="form-group row">
                                {{ Form::label('image','Image',['class'=>'col-sm-3'])}}
                                    <div class="col-sm-4">
                                        {{Form::file('image',['id'=>'image','required'=>(isset($data) ? false : true),'accept'=>'image/*'] ) }}
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
                        <div class="form-group row">
                            {{ Form::label('','',['class'=>'col-sm-3'])}}
                            <div class="col-sm-9">
                                {{ Form::button('<i class="fa fa-trash"></i>Reset',['class'=>'btn btn-sm btn-danger', 'id'=>'reset','type'=>'reset'] ) }}
                                {{-- {{ Form::button('<i class="fa fa-paper-plane"></i>Submit',['class'=>'btn btn-sm btn-success', 'id'=>'submit','type'=>'submit'] ) }} --}}
                                <button type="submit" class="btn btn-sm btn-success"> Submit</button>
                            </div>

                        </div>
                        {{ Form::close()}}
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
