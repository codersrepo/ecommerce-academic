@section('script')
<!-- <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script> -->

<script>
    $(document).ready(function() {

        $('#languageSwticher').change(handleLanguageSwitch);

        $('#form-submit').click(handleFormSubmitClickBtn)
    });

    function syncFormTrans(lang) {
        let translations = getFormTrans();

       Array.from(document.querySelectorAll('label[data-text]')).forEach((label) => {
            label.innerText = translations[lang][label.dataset.text];
        })
        translations = getCategoryTrans();
        Array.from(document.querySelectorAll('#category option')).forEach((option) => {
            console.log( translations[lang]);
            option.innerText = translations[lang][option.value];
        })
    }

    function getFormTrans() {
        let trans = [];
        @php
        $actualLocale = app()->getLocale();
        @endphp

        @foreach ($languages as $lang)
        {{ app()->setLocale($lang->prefix) }}
        trans['{{ $lang->prefix }}'] = @json(__("trans.form"));
        @endforeach

        {{ app()->setLocale($actualLocale) }}

        return trans;
    }

    function getCategoryTrans(){
        let trans = [];

        @foreach ($languages as $lang)
            trans['{{ $lang->prefix }}'] = [];
            @foreach($categories as $category)
                trans['{{ $lang->prefix }}']['{{ $category->id }}'] = "{{$category->getFromTranslations('title', $lang->id)}}";
            @endforeach
        @endforeach

        return trans;
    }

    function canSubmitForm() {
        let nextTab = true;
        let langTab = null;

        // looping through each form fields and checking for validaiton
        $.each($('#main-form').find('input,select').filter('[required]'), function() {
            let el = $(this)[0];
            el.classList.remove('is-invalid')

            if (!el.checkValidity() || el.value.trim() == '') {
                el.classList.add('is-invalid')

                if (langTab === null) {
                    // finding the closest lang-tab to the error field
                    langTab = el.closest('.lang-tab');

                    if (langTab) {
                        // unsetting the current active lang-tab
                        document.querySelector('.active-form').classList.add('d-none');
                        document.querySelector('.active-form').classList.remove('active-form')

                        // setting the langtab as active lang-tab
                        langTab.classList.remove('d-none')
                        langTab.classList.add('active-form')

                        // sync the value of language change dropdown
                        $('#languageSwticher').val(langTab.dataset.lang)
                        syncFormTrans(langTab.dataset.lang)
                    }
                }
                nextTab = false;
            }
        })

        return nextTab;
    }

    function handleFormSubmitClickBtn(e) {
        e.preventDefault();

        if (!canSubmitForm()) {
            $('#main-form-link').click()
            return;
        }

        $('.product-form').submit();
    }

    function handleLanguageSwitch(e) {
        document.querySelector('.active-form').classList.add('d-none');
        document.querySelector('.active-form').classList.remove('active-form')

        document.getElementById(`lang_${e.target.value}`).classList.remove('d-none')
        document.getElementById(`lang_${e.target.value}`).classList.add('active-form')

        syncFormTrans(e.target.value)
    }
</script>


@endsection

@extends('layouts.admin')
@section('content')
<div class="page-content fade-in-up">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-head">
                    <div class="ibox-title">
                        {{ $product->id ? __('trans.product.update') :
                            __('trans.product.add') }}
                    </div>
                    <div class="ibox-title">
                        <div class="row" style="align-items: center">
                            <div class="col-6">Language:</div>
                            <select class="col-6 form-control form-control-sm" name="" id="languageSwticher">
                                @foreach ($languages as $lang)
                                <option value="{{ $lang->prefix }}">{{ $lang->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
                <div class="ibox-body">
                    @if($product->id)
                    <form method="POST" action="{{ route('product.update', $product->id) }}" class="product-form" enctype="multipart/form-data">
                        @method('PUT')
                        @else
                        <form method="POST" action="{{ route('product.store') }}" class="product-form" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="tab-pane fade show active" id="main-form" role="tabpanel">
                            @foreach ($languages as $lang)
                                        <div id="lang_{{ $lang->prefix }}" data-lang="{{ $lang->prefix }}"
                                            class="lang-tab {{ $lang->prefix === 'en' ? 'active-form' : 'd-none' }}">
                                            <div class="form-group row">
                                                {{ Form::label('title_'.$lang->prefix, __('trans.title') . ":", ['class'=>'col-sm-12 col-md-3 required', 'data-text'=>'title']) }}
                                                <div class="col-sm-12 col-md-9">

                                                    {{ Form::text('title_'.$lang->prefix, $product->getFromTranslations('title', $lang->id), ['class'=>'form-control form-control-sm','id'=>'title_'.$lang->prefix,'required'=>true]) }}

                                                    @error('title_'.$lang->prefix)
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                {{ Form::label('summary_'.$lang->prefix, __('trans.summary') . ":", ['class'=>'col-sm-12 col-md-3 required', 'data-text'=>'summary']) }}
                                                <div class="col-sm-12 col-md-9">
                                                    {{ Form::textarea('summary_'.$lang->prefix, $product->getFromTranslations('summary', $lang->id), ['name' => 'summary_'.$lang->prefix, 'required' => true, 'class'=>'form-control form-control-sm','rows' => '4']) }}
                                                    @error('summary_'.$lang->prefix)
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                {{ Form::label('description_'.$lang->prefix, __('trans.description') . ":", ['class'=>'col-sm-12 col-md-3 required', 'data-text'=>'description']) }}
                                                <div class="col-sm-12 col-md-9">
                                                    {{ Form::textarea('description_'.$lang->prefix, $product->getFromTranslations('description', $lang->id), ['name' => 'description_'.$lang->prefix, 'required' => true, 'class'=>'form-control form-control-sm','rows' => '4']) }}
                                                    @error('description_'.$lang->prefix)
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        @endforeach

                                        <div class="form-group row">
                                                {{ Form::label('price', __('trans.price').":", ['class'=>'col-sm-12 col-md-3 required', 'data-text'=>'price']) }}
                                                <div class="col-sm-12 col-md-9">
                                                    {{ Form::text('price', @$product->price, ['name' => 'price', 'required' => true, 'class'=>'form-control form-control-sm','rows' => '4']) }}
                                                    @error('price')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                {{ Form::label('product_code', __('trans.product_code').":", ['class'=>'col-sm-12 col-md-3 required', 'data-text'=>'product_code']) }}
                                                <div class="col-sm-12 col-md-9">
                                                    {{ Form::text('product_code', @$product->product_code, ['name' => 'product_code', 'required' => true, 'class'=>'form-control form-control-sm','rows' => '4']) }}
                                                    @error('product_code')
                                                    <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                            {{ Form::label('category', __('trans.category.title').":", ['class'=>'col-sm-12 col-md-3 required', 'data-text'=>'category']) }}
                                            <div class="col-sm-12 col-md-9">
                                                <select name="category" id="category"
                                                    class="form-control form-control-sm" required>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ old('category') == $category->id ? 'selected' : '' }}
                                                        {{ $product->belongsToCategory($category) ? 'selected': '' }}>
                                                        {{ $category->getFromTranslations('title', 1) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('category')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                                <label class="col-sm-12 col-md-3">Product Size:</label>
                                                <div class="col-sm-12 col-md-9">
                                                <select class="form-control form-control-sm" required="required" name="size" class="js-select2">
                                                    <option value="" disabled>Choose an option</option>
                                                    <option value="large">Large</option>
                                                    <option value="medium">Medium</option>
                                                    <option value="small">Small</option>
                                                </select>
                                                </div>
                                            
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-12 col-md-3">Product Colour:</label>
                                                <div class="col-sm-12 col-md-9">
                                                <select class="form-control form-control-sm" required="required" name="colour" class="js-select2">
                                                    <option value="" disabled>Choose an option</option>
                                                    <option value="red">Red</option>
                                                    <option value="blue">Blue</option>
                                                    <option value="white">White</option>
                                                    <option value="grey">Grey</option>
                                                </select>
                                                </div>
                                            
                                            </div>

                                        <div class="form-group row">
                                            {{ Form::label('status', __('trans.status').":", ['class'=>'col-sm-12 col-md-3 required', 'data-text'=>'status']) }}
                                            <div class="col-sm-12 col-md-9">
                                                {{ Form::select('status',['active'=>__('trans.active'), 'inactive'=>__('trans.inactive')], $product->status, ['class'=>'form-control form-control-sm', 'id'=>'status','required'=>true]) }}
                                                @error('status')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
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
                                                {{ Form::label('images[]','Image',['class'=>'col-sm-3'])}}
                                                    <div class="col-sm-4">
                                                        {{Form::file('image_id[]',['id'=>'image_id[]','required'=>(isset($data) ? false : true),'accept'=>'image/*','multiple' => true] ) }}
                                                        @error('image_id')
                                                        <span class="alert-danger">{{$message}}  </span>
                                                        @enderror
                                                    </div>
                                            </div>
                                    </div>
                                        <div class="form-group row">
                                            <div class="col-sm-12 col-md-9 offset-md-3">
                                                {{ Form::button("<i class='fa fa-times'></i> ".__('trans.cancelButton'), ['class' => 'btn btn-danger btn-sm', 'type'=>'reset']) }}
                                                {{ Form::button("<i class='fa fa-paper-plane'></i> ".__('trans.submitButton'), ['class' => 'btn btn-success btn-sm', 'id'=>'form-submit']) }}
                                            </div>
                                  </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    @endsection