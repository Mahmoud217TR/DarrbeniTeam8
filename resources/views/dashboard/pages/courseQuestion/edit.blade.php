@extends('dashboard.layout.form')


@section('form_input')
    <a href="{{ route('courseQuestion.index') }}" class="btn btn-primary btn-xs">Course Question</a>

    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
    action="{{ route('courseQuestion.update',$courseQuestion->uuid) }}">
    @csrf
    @method('put')

    <div class="widget-main">
       
        <div class="tab-content padding-4">
            
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="question">

                    question
                 </label>
                 <div class="col-sm-4">
                    <textarea class="col-xs-10 col-sm-12" type="text" 
                         name="question" id="question" >{{ $courseQuestion->question }}</textarea>
                     @error('question')
                         <div>{{ $message }}</div>
                     @enderror
                 </div>
            </div><br><br>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="reference">

                    Reference
                 </label>
                 <div class="col-sm-4">
                     <textarea class="col-xs-10 col-sm-12" type="text" 
                         name="reference" id="reference" >{{ $courseQuestion->reference->reference }}</textarea>
                     @error('reference')
                         <div>{{ $message }}</div>
                     @enderror
                 </div>
            </div><br><br>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="course_id">Course Name</label>
                <div class="col-sm-4">
                    <select class="col-xs-10 col-sm-5" name="course_id" id="course_id">
                        <option value="">{{ $courseQuestion->course->name }}</option>
                        @foreach ($course as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                            
                        @endforeach
                    </select>
                    @error('course_id')
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
