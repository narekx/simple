@extends('back.layout.main')
@section('content')
    <style>
        /* HIDE RADIO */
        [type=radio] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        [type=radio] + img {
            cursor: pointer;
        }

        /* CHECKED STYLES */
        [type=radio]:checked + img {
            outline: 2px solid #f00;
        }

        .icons img {
            width: 75px;
            height: 75px;
            margin-right: 5px;
        }

        input[type=checkbox] {
            width: 20px;
            height: 20px;
        }

        img#image {
            width: 400px;
            height: auto;
            padding-left: 15px;
        }

        #iconElement {
            filter: invert(42%) sepia(93%) saturate(1352%) hue-rotate(87deg) brightness(119%) contrast(0);
            width: 25px;
            height: 25px;
        }
    </style>
    <!-- widget grid -->
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <!-- NEW COL START -->
            <article class="col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
                    <!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
                        data-widget-colorbutton="false"
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true"
                        data-widget-sortable="false"
                    -->
                    <header>
                        <span class="widget-icon"> <i class="fa fa-edit"></i> </span>

                        <h2>Կատեգորիա</h2>

                    </header>

                    <!-- widget div-->
                    <div>
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->
                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            <form action="{{ route('admin.categories.update', ['id' => $category->id]) }}" method="POST" class="smart-form" enctype="multipart/form-data">
                                @csrf

                                <div class="col-xs-12">
                                    <section class="col col-6">
                                        <label for="name" class="input">{{ __('Անուն') }}</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') ?? $category->name }}">
                                        <span style="color: red">{{ $errors->category->first('name') }}</span>
                                    </section>
                                    <section class="col col-6">
                                        <label for="slug" class="input">{{ __('Սլագ') }}</label>
                                        <input type="text" name="slug" class="form-control" value="{{ old('slug') ?? $category->slug }}">
                                        <span style="color: red">{{ $errors->category->first('slug') }}</span>
                                    </section>
                                </div>
                                <div class="col-xs-12">
                                    <section class="col col-6">
                                        <label for="order" class="input">{{ __('Հերթականություն') }}</label>
                                        <input type="number" name="order" class="form-control" value="{{ old('order') ?? $category->order }}">
                                        <span style="color: red">{{ $errors->category->first('order') }}</span>
                                    </section>
                                    <section class="col col-6">
                                        <label for="order" class="input">{{ __('Ստատուս') }}</label>
                                        <select name="status" class="form-control">
                                            @foreach($statuses as $key => $value)
                                                <option value="{{ $key }}" {{ ($key == old('status') || $key == $category->status) ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <span style="color: red">{{ $errors->category->first('status') }}</span>
                                    </section>
                                </div>
                                <div class="col-xs-12">
                                    <section class="col col-6">
                                        <label for="icon" class="input">{{ __('Իկոն') }}</label>
                                        <select name="icon" class="form-control" id="iconSelect">
                                            <option value="">Չկա</option>
                                            @foreach($icons as $icon)
                                                <option value="{{ $icon }}" {{ $icon == old('icon') || $icon == $category->icon ? 'selected' : '' }}>{{ $icon }}</option>
                                            @endforeach
                                        </select>
                                        <img src="{{ asset($category->icon_path) }}" alt="icon" width="15px" height="15px" id="iconElement">
                                        <span style="color: red">{{ $errors->category->first('icon') }}</span>
                                    </section>
                                    <div class="col col-6">
                                        <label for="images" class="input">{{ __('Նկար') }}</label>
                                        <input type="file" id="images_input" name="images">
                                        <span style="color: red">{{ $errors->category->first('images') }}</span>
                                    </div>
                                </div>
                                <div class="col-xs-12">
                                    <img src="{{ asset($category->image_path) }}" alt="Image" id="image">
                                </div>
                                <div class="col-xs-12">
                                    <input type="submit" class="btn btn-primary" value="Պահպանել">
                                </div>
                            </form>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->
            </article>
            <!-- END COL -->
        </div>
        <!-- end row -->
    </section>
@stop
@section('scripts')
    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="{{asset('/back/js/plugin/jquery-form/jquery-form.min.js')}}"></script>


    <script type="text/javascript">
        const imagesInput = document.querySelector('#images_input');
        const image = document.querySelector('#image');
        imagesInput.onchange = evt => {
            const [file] = imagesInput.files
            if (file) {
                image.src = URL.createObjectURL(file)
            }
        }

        const iconSelect = document.querySelector('#iconSelect');
        const iconElement = document.querySelector('#iconElement');
        const dir = "{{asset('static/img/icons/')}}";
        iconSelect.onchange = evt => {
            iconElement.src = dir + '/' + iconSelect.value + '.svg';
        }

        // DO NOT REMOVE : GLOBAL FUNCTIONS!

        $(document).ready(function () {
            pageSetUp();

            var depends = {
                depends: function () {
                    return !$("input[name='id']").val();
                }
            };


            $(".f1").on("click",function(argument) {
                $("#icone").val($(this).children( ".fa" ).attr('class'))
            })

            $("#smart-form-register").validate({
                // Rules for form validation
                rules: {
                    email: {
                        required: depends
                    },
                    password: {
                        required: depends,
                        minlength: 3,
                        maxlength: 20
                    },
                    password_confirmation: {
                        required: depends,
                        minlength: 3,
                        maxlength: 20,
                        equalTo: '#password'
                    },
                    first_name: {
                        required: true
                    },
                    last_name: {
                        required: true,
                    }
                },

                // Messages for form validation
                messages: {
                    password: {
                        required: 'Please enter your password'
                    },
                    password_confirmation: {
                        required: 'Please enter your password one more time',
                        equalTo: 'Please enter the same password as above'
                    },
                    first_name: {
                        required: 'Please select your first name'
                    },
                    last_name: {
                        required: 'Please select your last name'
                    }
                },

                // Do not change code below
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }
            });
        })
    </script>
@stop
