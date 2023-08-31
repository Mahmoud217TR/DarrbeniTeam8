@extends('dashboard.layout.form')


@section('form_input')
    <a href="{{ route('slider.index') }}" class="btn btn-primary btn-xs">slider</a>

    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
    action="{{ route('slider.store') }}">
    @csrf
    <div class="widget-main">
       
        <div class="tab-content padding-4">
            
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="link">

                    link
                 </label>
                 <div class="col-sm-4">
                     <input class="col-xs-10 col-sm-5" type="text" 
                         name="link" id="link" >
                     @error('link')
                         <div>{{ $message }}</div>
                     @enderror
                 </div>
            </div><br><br>
           
        </div><br><br>
        <div class="form-group">
            <label for="file" class="col-sm-2 control-label no-padding-right">@lang('dashboard.image')
            </label>
            <div>

                <div class="form-group">
                    <div class="col-xs-9">
                        <input name="image" type="file" id="id-input-file-3" />

                        <!-- /section:custom/file-input -->
                    </div>
                </div>
                @error('image')
                    <div>{{ $message }}</div>
                @enderror

            </div>
            @push('js')
                <script type="text/javascript">
                    jQuery(function($) {




                        //pre-show a file name, for example a previously selected file
                        //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt')


                        $('#id-input-file-3').ace_file_input({
                            style: 'well',
                            btn_choose: 'Drop files here or click to choose',
                            btn_change: null,
                            no_icon: 'ace-icon fa fa-cloud-upload',
                            droppable: true,
                            thumbnail: 'small' //large | fit
                                //,icon_remove:null//set null, to hide remove/reset button
                                /**,before_change:function(files, dropped) {
                                    //Check an example below
                                    //or examples/file-upload.html
                                    return true;
                                }*/
                                /**,before_remove : function() {
                                    return true;
                                }*/
                                ,
                            preview_error: function(filename, error_code) {
                                //name of the file that failed
                                //error_code values
                                //1 = 'FILE_LOAD_FAILED',
                                //2 = 'IMAGE_LOAD_FAILED',
                                //3 = 'THUMBNAIL_FAILED'
                                //alert(error_code);
                            }

                        }).on('change', function() {
                            //console.log($(this).data('ace_input_files'));
                            //console.log($(this).data('ace_input_method'));
                        });


                        //$('#id-input-file-3')
                        //.ace_file_input('show_file_list', [
                        //{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
                        //{type: 'file', name: 'hello.txt'}
                        //]);




                        /////////
                        $('#modal-form input[type=file]').ace_file_input({
                            style: 'well',
                            btn_choose: 'Drop files here or click to choose',
                            btn_change: null,
                            no_icon: 'ace-icon fa fa-cloud-upload',
                            droppable: true,
                            thumbnail: 'large'

                        })

                        //chosen plugin inside a modal will have a zero width because the select element is originally hidden
                        //and its width cannot be determined.
                        //so we set the width after modal is show
                        $('#modal-form').on('shown.bs.modal', function() {
                            if (!ace.vars['touch']) {
                                $(this).find('.chosen-container').each(function() {
                                    $(this).find('a:first-child').css('width', '210px');
                                    $(this).find('.chosen-drop').css('width', '210px');
                                    $(this).find('.chosen-search input').css('width', '200px');
                                });
                            }
                        })
                        /**
                        //or you can activate the chosen plugin after modal is shown
                        //this way select element becomes visible with dimensions and chosen works as expected
                        $('#modal-form').on('shown', function () {
                            $(this).find('.modal-chosen').chosen();
                        })
                        */



                        $(document).one('ajaxloadstart.page', function(e) {
                            $('textarea[class*=autosize]').trigger('autosize.destroy');
                            $('.limiterBox,.autosizejs').remove();
                            $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu')
                                .remove();
                        });

                    });
                </script>
            @endpush

        </div>

        
        <div class="form-group">
            <div class="col-sm-6 control-label no-padding-right">
                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>save</button>
            </div>
        </div>

    </div>
</form>
@endsection
