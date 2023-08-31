@extends('dashboard.layout.form')


@section('form_input')
    <a href="{{ route('notification.index') }}" class="btn btn-primary btn-xs">notification</a>

    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
        action="{{ route('notification.store') }}">
        @csrf
        <div class="widget-main">

            <div class="tab-content padding-4">
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="title">

                        Title
                    </label>
                    <div class="col-sm-4">
                        <input class="col-xs-10 col-sm-8" type="text" name="title" id="title">
                        @error('title')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                </div><br><br>

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="description">

                        Description
                    </label>
                    <div class="col-sm-4">
                        <textarea class="col-xs-10 col-sm-12" type="text" name="description" id="description"></textarea>
                        @error('description')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                </div><br><br>



            </div><br><br>



            <div class="form-group">
                <div class="col-sm-6 control-label no-padding-right">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>save</button>
                </div>
            </div>

        </div>
    </form>
@endsection
