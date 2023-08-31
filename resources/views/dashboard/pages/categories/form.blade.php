@extends('dashboard.layout.form')


@section('form_input')
<a href="{{ route('category.index') }}" class="btn btn-primary btn-xs">Category</a>
<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
    action="{{ route('category.store') }}">
    @csrf
    <div class="widget-main">
        <div class="tab-content padding-4">
            <div class="form-group">

                <label class="col-sm-2 control-label no-padding-right" for="name">

                   Name
                </label>
                <div class="col-sm-4">
                    <input class="col-xs-10 col-sm-5" type="text" 
                        name="name" id="name" >
                    @error('name')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
            </div><br><br>

        </div>

     
    </div><br><br>


    <div class="form-group">
        <div class="col-sm-6 control-label no-padding-right">
            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>save</button>
        </div>
    </div>

    </div>
</form>



    <script>
        function previewFile(input) {
            var file = $("input[type=file]").get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    $("#previewImage").attr("src", reader.result);
                }
                reader.readAsDataURL(file);


            }
        }
    </script>
@endsection
