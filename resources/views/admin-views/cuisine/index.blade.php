@extends('layouts.admin.app')

@section('title',translate('messages.Add new cuisine'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h2 class="page-header-title text-capitalize">
                        <div class="card-header-icon d-inline-flex mr-2 img">
                            <img src="{{asset('public/assets/admin/img/cuisine.png')}}" alt="">
                        </div>
                        <span>
                            {{translate('cuisine')}}
                        </span>
                    </h2>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="card resturant--cate-form">
            <div class="card-body">
                <form action="{{route('admin.cuisine.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @php($language = \App\Models\BusinessSetting::where('key', 'language')->first())
                    @php($language = $language->value ?? null)
                    @php($default_lang = 'bn')
                    <div class="row">
                        @if ($language)
                            @php($default_lang = json_decode($language)[0])
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs mb-4">
                                    @foreach (json_decode($language) as $lang)
                                        <li class="nav-item">
                                            <a class="nav-link lang_link {{ $lang == $default_lang ? 'active' : '' }}"
                                                href="#"
                                                id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($language)
                        <div class="col-md-12 col-lg-12">
                            @foreach (json_decode($language) as $lang)
                                <div class="{{ $lang != $default_lang ? 'd-none' : '' }} lang_form"
                                    id="{{ $lang }}-form">
                                    <div class="form-group mb-3">
                                        <label class="input-label"
                                            for="{{ $lang }}_name">{{ translate('messages.name') }}
                                            ({{ strtoupper($lang) }})
                                        </label>
                                        <!-- <label class="input-label" for="exampleFormControlInput1">{{translate('messages.name')}}</label> -->
                                        <!-- <input type="text" name="name" class="form-control" placeholder="New cuisine" required> -->
                                        <input type="text" name="name[]" id="{{ $lang }}_name"
                                            class="form-control"
                                            placeholder="{{ translate('messages.name') }}"
                                            {{ $lang == $default_lang ? 'required' : '' }}
                                            oninvalid="document.getElementById('en-link').click()">
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                    </div>

                                    <!-- <div class="form-group">
                                        <label class="input-label"
                                            for="{{ $lang }}_name">{{ translate('messages.name') }}
                                            ({{ strtoupper($lang) }})
                                        </label>
                                        <input type="text" name="name[]" id="{{ $lang }}_name"
                                            class="form-control"
                                            placeholder="{{ translate('messages.new_food') }}"
                                            {{ $lang == $default_lang ? 'required' : '' }}
                                            oninvalid="document.getElementById('en-link').click()">
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.short') }}
                                            {{ translate('messages.description') }}
                                            ({{ strtoupper($lang) }})</label>
                                        <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"></textarea>
                                    </div> -->
                                </div>
                            @endforeach
                        </div>
                        @else
                        <div id="{{ $default_lang }}-form">
                            <div class="form-group mb-3">
                                <label class="input-label"
                                    for="exampleFormControlInput1">{{ translate('messages.name') }}
                                    (EN)</label>
                                <!-- <label class="input-label" for="exampleFormControlInput1">{{translate('messages.name')}}</label> -->
                                <input type="text" name="name" class="form-control" placeholder="New cuisine" required>
                                <!-- <input type="text" name="name[]" id="{{ $lang }}_name"
                                    class="form-control"
                                    placeholder="{{ translate('messages.name') }}"
                                    {{ $lang == $default_lang ? 'required' : '' }}
                                    oninvalid="document.getElementById('en-link').click()">
                                <input type="hidden" name="lang[]" value="{{ $lang }}"> -->
                            </div>

                            <!-- <div class="form-group">
                                <label class="input-label"
                                    for="{{ $lang }}_name">{{ translate('messages.name') }}
                                    ({{ strtoupper($lang) }})
                                </label>
                                <input type="text" name="name[]" id="{{ $lang }}_name"
                                    class="form-control"
                                    placeholder="{{ translate('messages.new_food') }}"
                                    {{ $lang == $default_lang ? 'required' : '' }}
                                    oninvalid="document.getElementById('en-link').click()">
                            </div>
                            <div class="form-group mb-0">
                                <label class="input-label"
                                    for="exampleFormControlInput1">{{ translate('messages.short') }}
                                    {{ translate('messages.description') }}
                                    ({{ strtoupper($lang) }})</label>
                                <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"></textarea>
                            </div> -->
                        </div>

                            <!-- <div class="card-body">
                                <div id="{{ $default_lang }}-form">
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.name') }}
                                            (EN)</label>
                                        <input type="text" name="name[]" class="form-control"
                                            placeholder="{{ translate('messages.new_food') }}" required>
                                    </div>
                                    <input type="hidden" name="lang[]" value="en">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.short') }}
                                            {{ translate('messages.description') }}</label>
                                        <textarea type="text" name="description[]" class="form-control ckeditor min-height-154px"></textarea>
                                    </div>
                                </div>
                            </div> -->
                        @endif
                        <!-- <div class="col-md-12 col-lg-12">
                            <div class="form-group mb-3">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('messages.name')}}</label>
                                <input type="text" name="name" class="form-control" placeholder="New cuisine" required>
                            </div>
                        </div> -->
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-lg-12">
                            <div class="form-group mb-0">
                                <center id="image-viewer-section">
                                    <img class="initial-18" id="viewer"
                                        src="{{ asset('public/assets/admin/img/160x160/img2.png') }}"
                                        onerror="this.src='{{ asset('public/assets/admin/img/160x160/img2.png') }}'"
                                        alt="image"/>
                                </center>
                            </div>
                            <div class="form-group mt-2">
                                <label>{{translate('messages.image')}}</label><small class="text-danger">* ( {{translate('messages.ratio')}} 1:1)</small>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                                    <label class="custom-file-label" for="customFileEg1">{{translate('messages.choose')}} {{translate('messages.file')}}</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group pt-2 mb-0">
                            <div class="btn--container justify-content-end">
                                <!-- Static Button -->
                                <button id="reset_btn" type="reset" class="btn btn--reset">{{translate('messages.reset')}}</button>
                                <!-- Static Button -->
                                <button type="submit" class="btn btn--primary">{{translate('messages.submit')}}</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header py-2">
                <div class="search--button-wrapper">
                    <h5 class="card-title"><span class="card-header-icon">
                        <i class="tio-cuisine-outlined"></i>
                    </span> {{translate('messages.cuisine')}} {{translate('messages.list')}}<span class="badge badge-soft-dark ml-2" id="itemCount">{{$cuisine->total()}}</span></h5>
                    <form >

                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input type="search" name="search" class="form-control" placeholder="{{ translate('Ex : search_by_name') }}" aria-label="{{translate('messages.search_cuisine')}}">
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                        </div>
                        <!-- End Search -->
                    </form>

                </div>
            </div>
            <div class="table-responsive datatable-custom">
                <table id="columnSearchDatatable"
                    class="table table-borderless table-thead-bordered table-align-middle"
                    data-hs-datatables-options='{
                        "isResponsive": false,
                        "isShowPaging": false,
                        "paging":false,
                    }'>
                    <thead class="thead-light">
                        <tr>
                            <th  class="text-cetner w-25px" > {{ translate('messages.sl') }}</th>
                            <th class="text-cetner w-25px">{{translate('messages.image')}}</th>
                            <th class="text-cetner w-130px">{{translate('messages.name')}}</th>
                            <th class="text-cetner w-130px"> {{translate('messages.status')}}</th>
                            <th class="text-cetner w-130px">{{translate('messages.action')}}</th>
                        </tr>
                    </thead>

                    <tbody id="table-div">
                    @foreach($cuisine as $key=>$cu)
                        <tr>
                            <td>
                                <div class="pl-3">
                                    {{$key+$cuisine->firstItem()}}
                                </div>
                            </td>
                            @php($img_src =  isset($cu->image) ?  asset('storage/app/public/cuisine').'/'.$cu['image'] : asset('public/assets/admin/img/900x400/img2.jpg')  )
                            <td>
                                <span class="media align-items-center">
                                    <img class="avatar avatar-lg object--contain object--start avatar--3-1" src="{{$img_src}}" onerror="this.src='{{$img_src}}'" alt="{{$cu->name}} image">
                                </span>
                            </td>
                            <td>
                            <span class="d-block font-size-sm text-body">
                                {{Str::limit($cu['name'], 20,'...')}}
                            </span>
                            </td>
                            <td>
                                <label class="toggle-switch toggle-switch-sm ml-2" for="stocksCheckbox{{$cu->id}}">
                                <input type="checkbox" onclick="location.href='{{route('admin.cuisine.status',[$cu['id'],$cu->status?0:1])}}'"class="toggle-switch-input" id="stocksCheckbox{{$cu->id}}" {{$cu->status?'checked':''}}>
                                    <span class="toggle-switch-label">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>

                            <td>
                                <?php
                                $ar_name = DB::table('translations')->where('translationable_type', 'App\Models\Cuisine')->where('translationable_id', $cu['id'])->where('locale', 'ar')->where('key', 'name')->pluck('value'); ?>
                                {{$ar_name}}
                                <div class="btn--container">
                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                    data-id={{ $cu['id'] }} title="{{ translate('messages.edit') }}"
                                    onClick="javascript:showMyModal('{{ $cu['id'] }}', '{{ $cu->name }}', {{ $img_src }}, {{$ar_name}}')"
                                    ><i class="tio-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn" href="javascript:"
                                    onclick="form_alert('cuisine-{{$cu['id']}}','{{ translate('Want to delete this cuisine') }}')" title="{{translate('messages.delete')}} {{translate('messages.cuisine')}}"><i class="tio-delete-outlined"></i>
                                    </a>
                                </div>

                                <form action="{{route('admin.cuisine.delete',['id' =>$cu['id']])}}" method="post" id="cuisine-{{$cu['id']}}">
                                    @csrf @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if(count($cuisine) === 0)
                <div class="empty--data">
                    <img src="{{asset('/public/assets/admin/img/empty.png')}}" alt="public">
                    <h5>
                        {{translate('no_data_found')}}
                    </h5>
                </div>
                @endif
            </div>
            <div class="card-footer pt-0 border-0">
                <div class="page-area px-4 pb-3">
                    <div class="d-flex align-items-center justify-content-end">
                        <div>
                            {!! $cuisine->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ translate('messages.Update') }}</label></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.cuisine.update',)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" id="id" />
                        <input class="form-control" name='name' id="name" required type="text">
                        <input class="form-control" name='ar_name' id="ar_name" required type="text">

                        {{-- <div class="col-md-6 col-lg-6"> --}}
                            <div class="form-group mt-5">
                                <center id="image-viewer-section3" >
                                    <img class="initial-18" id="viewer2"
                                        {{-- src="{{ asset('public/assets/admin/img/160x160/img2.png') }}" --}}
                                        onerror="this.src='{{ asset('public/assets/admin/img/160x160/img2.png') }}'"
                                        alt="image"/>
                                </center>
                            </div>
                            <div class="form-group mt-2">
                                <label>{{translate('messages.image')}}</label><small class="text-danger">* ( {{translate('messages.ratio')}} 1:1)</small>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg2" class="custom-file-input"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" >
                                    <label class="custom-file-label" for="customFileEg2">{{translate('messages.choose')}} {{translate('messages.file')}}</label>
                                </div>
                            </div>
                        {{-- </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate('Close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ translate('Save_changes') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_2')

    <script>
        function readURL(input, viewer) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#' + viewer).attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function() {
            readURL(this, 'viewer');
            $('#image-viewer-section').show(1000);
        });
        $("#customFileEg2").change(function() {
            readURL(this, 'viewer2');
            $('#image-viewer-section3').show(1000);
        });
    </script>

    <script>
        $('#reset_btn').click(function(){
            $('#name').val(null);
            $('#viewer').attr('src', "{{asset('public/assets/admin/img/100x100/food-default-image.png')}}");
            $('#customFileEg1').val(null);

        })

    </script>

    <script>
        $(".lang_link").click(function(e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.substring(0, form_id.length - 5);
            console.log(lang);
            $("#" + lang + "-form").removeClass('d-none');
            if (lang == '{{ $default_lang }}') {
                $("#from_part_2").removeClass('d-none');
            } else {
                $("#from_part_2").addClass('d-none');
            }
        })
    </script>

    <script>
        function showMyModal(id, name, image) {
            $(".modal-body #id").val(id);
            $(".modal-body #name").val(name);
            $(".modal-body #viewer2").attr("src", image);
            $('#exampleModal').modal('show');
        }
    </script>
@endpush
