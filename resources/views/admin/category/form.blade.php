@section('script')
<!-- <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script> -->

<script>
    $(document).ready(function() {

        $('#languageSwticher').change(handleLanguageSwitch);

        $('#form-submit').click(handleFormSubmitClickBtn)
    });

    function syncFormTrans(lang) {
        const translations = getFormTrans();

        Array.from(document.querySelectorAll('label[data-text]')).forEach((label) => {
            label.innerText = translations[lang][label.dataset.text];
        })
    }

    function getFormTrans() {
        let trans = [];
        @php
        $actualLocale = app() - > getLocale();
        @endphp

        @foreach($languages as $lang) {
            {
                app() - > setLocale($lang - > prefix)
            }
        }
        trans['{{ $lang->prefix }}'] = @json(__("trans.form"));
        @endforeach

        {
            {
                app() - > setLocale($actualLocale)
            }
        }

        return trans;
    }

    function setupFileManagers() {
        $('#lfm1').filemanager('image');
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

        $('.category-form').submit();
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
                        {{ $category->id ? __('trans.category.update') :
                            __('trans.category.add') }}
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
                    @if($category->id)
                    <form method="POST" action="{{ route('category.update', $category->id) }}" class="category-form" enctype="multipart/form-data">
                        @method('PUT')
                        @else
                        <form method="POST" action="{{ route('category.store') }}" class="category-form" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="tab-pane fade show active" id="main-form" role="tabpanel">
                                @foreach ($languages as $lang)
                                <div id="lang_{{ $lang->prefix }}" data-lang="{{ $lang->prefix }}" class="lang-tab {{ $lang->prefix === 'en' ? 'active-form' : 'd-none' }}">
                                    <div class="form-group row">
                                        <label for="" class="col-sm-12 col-md-3 ">Title</label>
                                        <div class="col-sm-12 col-md-9">

                                            {{ Form::text('title_'.$lang->prefix, $category->getFromTranslations('title', $lang->id), ['class'=>'form-control form-control-sm','id'=>'title_'.$lang->prefix,'required'=>true]) }}

                                            @error('title_'.$lang->prefix)
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-sm-12 col-md-3 ">Summary</label>
                                        <div class="col-sm-12 col-md-9">
                                            {{ Form::textarea('summary_'.$lang->prefix, $category->getFromTranslations('summary', $lang->id), ['name' => 'summary_'.$lang->prefix, 'required' => true, 'class'=>'form-control form-control-sm','rows' => '4']) }}
                                            @error('summary_'.$lang->prefix)
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <div class="form-group row">
                                    <label for="" class="col-sm-12 col-md-3">Status</label>
                                    <div class="col-sm-12 col-md-9">
                                        {{ Form::select('status',['active'=>__('trans.active'), 'inactive'=>__('trans.inactive')], $category->status, ['class'=>'form-control form-control-sm', 'id'=>'status','required'=>true]) }}
                                        @error('status')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-sm-12 col-md-3">Image</label>
                                    <div class="col-sm-4">
                                        <input type="file" name="image" id="image" value="{{ old('image') ?? $category->image }}">
                                        @error('image')
                                        <span class="alert-danger">{{$message}} </span>
                                        @enderror
                                    </div>
                                    <div id="holder1" class="col-sm-12 col-md-5">
                                        @if($category->id)
                                        <img style="max-width: 150px" src="{{ asset('images/categories/'.$category->image) }}" alt="Category_image">
                                        @endif
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