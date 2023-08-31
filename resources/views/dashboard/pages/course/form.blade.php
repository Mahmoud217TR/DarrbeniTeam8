@extends('dashboard.layout.form')


@section('form_input')
    <a href="{{ route('course.index') }}" class="btn btn-primary btn-xs">Course</a>

    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
        action="{{ route('course.store') }}">
        @csrf
        <div class="widget-main">

            <div class="tab-content padding-4">

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="name">

                        Name
                    </label>
                    <div class="col-sm-4">
                        <input class="col-xs-10 col-sm-5" type="text" name="name" id="name">
                        @error('name')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                </div><br><br>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="specialization_id">specialization</label>
                    <div class="col-sm-4">
                        <select class="col-xs-10 col-sm-5" name="specialization_id" id="specialization_id">
                            <option value="">Select a specialization</option>
                         @foreach ($specialization as $item)
                         <option value="{{ $item->id }}">{{ $item->name }}</option>
                         @endforeach
                           
                                
                          
                        </select>
                        @error('specialization_id')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
            </div><br><br>



            <div class="form-group">
                <div class="col-sm-6 control-label no-padding-right">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i>save</button>
                </div>
            </div>

        </div>
    </form>
@endsection
