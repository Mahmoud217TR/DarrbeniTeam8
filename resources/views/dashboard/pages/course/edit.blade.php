@extends('dashboard.layout.form')


@section('form_input')
    <a href="{{ route('course.index') }}" class="btn btn-primary btn-xs">course</a>

    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
        action="{{ route('course.update', $course->uuid) }}">
        @csrf
        @method('put')

        <div class="widget-main">

            <div class="tab-content padding-4">

                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="name">

                        Name
                    </label>
                    <div class="col-sm-4">
                        <input class="col-xs-10 col-sm-5" type="text" name="name" id="name " value="{{ $course->name }}">
                        @error('name')
                            <div>{{ $message }}</div>
                        @enderror
                    </div>
                </div><br><br>
                <div class="form-group">
                    <label class="col-sm-2 control-label no-padding-right" for="specialization_id">specialization</label>
                    <div class="col-sm-4">
                        <select class="col-xs-10 col-sm-5" name="specialization_id" id="specialization_id">
                            <option value="">{{ $course->spacialization->name }}</option>
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
