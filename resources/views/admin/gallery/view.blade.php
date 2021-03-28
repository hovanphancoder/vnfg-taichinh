<?php
//$lang = (session('locale') == 'en')?'en':'vn';
if($_SERVER['HTTP_HOST'] == "localhost")
    $pathtinymce = "/makeuphouse/public/admin_assets/filemanager/";
else{
    $pathtinymce = "http://vam.tuvanthietkeweb.net/public/admin_assets/filemanager/";
}
?>
@extends('admin.dashboard')
@section('title', 'Page Title')
@section('assets')
<script src="{!!url('admin_assets/tinymce/js/tinymce/tinymce.min.js')!!}"></script>
<script>
    tinymce.init({

        editor_selector: "mceEditor",
        selector: '#content_vn', height: 500,
        plugins: ["advlist autolink link image lists charmap preview hr anchor pagebreak", "code searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking", "table contextmenu directionality emoticons paste textcolor responsivefilemanager fullscreen"],
        toolbar1: "insertfile undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent",
        toolbar2: "fontsizeselect | forecolor backcolor | responsivefilemanager | link unlink anchor | image media | fullscreen preview code",
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
        image_advtab: true,
        relative_urls: false,
        nowrap: false,
		filemanager_sort_by: "date",
		filemanager_descending: 1,
		content_css : "{!!asset('admin_assets/css/editor-style.css')!!}",

        /*external_filemanager_path:"{!!url('admin_assets/filemanager/'.'/')!!}",*/
        external_filemanager_path: "<?php echo $pathtinymce?>",
        filemanager_title: "Responsive Filemanager",
        external_plugins: {"filemanager": "{{asset('admin_assets/tinymce/js/tinymce/plugins/responsivefilemanager/filemanager/plugin.min.js')}}"}
    });
</script>
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
        
        <!-- Breadcromb Row Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="breadcromb-area">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="seipkon-breadcromb-left">
                                <h3>Edit Gallery</h3>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="seipkon-breadcromb-right">
                                <ul>
                                    <li><a href="#">home</a></li>
                                    <li>gallery</li>
                                    <li>Edit gallery</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Breadcromb Row -->
        
        @if(Session::has('status'))
                <!--<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>-->
        <div class="alert alert-success fade in alert-dismissible" style="margin-top:18px;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
            {!!Session::get('status')!!}
        </div>
        @endif

        <!-- Pages Table Row Start -->
        <div class="row">
            <div class="col-md-12">
                <div class="page-box">
                    <form action="{!!action('Admin\GalleryController@edit', $view->id)!!}" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                            <div class="col-md-9">
                                <div class="create-page-left">
                                    <div class="form-group">
                                        <img class="marrig5" src="{!!url('admin_assets/img/'.session('locale').'.png')!!}"><label>Tiêu đề</label>
                                        <input type="text" name="title_{!!session('locale')!!}" placeholder="Enter Page Title" value="{!!$view->title!!}" >
                                    </div>
                                    
                                    <div class="form-group">
                                        <img class="marrig5" src="{!!url('admin_assets/img/'.session('locale').'.png')!!}"><label class="control-label" for="message">Mô tả</label>
                                        <textarea name="description_{!!session('locale')!!}" class="form-control" id="description_{!!session('locale')!!}" placeholder="Description">{!!$view->description!!}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <img class="marrig5" src="{!!url('admin_assets/img/'.session('locale').'.png')!!}"><label>Nội dung</label>
                                        <textarea maxlength="255" name="content_{!!session('locale')!!}" id="content_{!!session('locale')!!}">{!!$view->content!!}</textarea>
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="create-page-right">
                                    <div class="form-group"></div>
                                    <div class="form-group"></div>
                                    <div class="form-group form-checkbox"></div>
                                    <div class="page-img-upload">
                                        <img class="marrig5" src="{!!url('admin_assets/img/'.session('locale').'.png')!!}"><label>Feature image</label><br>
                                        <img src="{!!url('images/upload/gallery/'.$view->image)!!}" alt="Breadcromb">
                                        <div class="product-upload btn btn-info">
                                            <i class="fa fa-upload"></i>
                                            Upload Image
                                            <input type="file" class="custom-file-input form-control" id="customFile" name="image">
                                            <input type="hidden" name="old_image" value="{!!$view->image!!}">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="form-layout-submit">
                            <p>
                                <button type="submit" class="btn btn-success" ><i class="fa fa-check"></i>Update</button>
                                <a class="btn btn-default" href="{!!url('admin/gallery/list')!!}" role="button"><i class="fa fa-chevron-left"></i> Back</a>
                            </p>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- End Pages Table Row -->

    </div>
</div>

<!-- Footer Area Start -->
<footer class="seipkon-footer-area">
    @include('admin/layouts/footer')
</footer>
<!-- End Footer Area -->
@endsection
@section('assetjs')
@endsection