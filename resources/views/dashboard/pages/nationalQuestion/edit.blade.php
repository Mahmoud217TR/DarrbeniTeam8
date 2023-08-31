@extends('dashboard.layout.form')


@section('form_input')
    <a href="{{ route('nationalQuestion.index') }}" class="btn btn-primary btn-xs">National Question</a>

    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
    action="{{ route('nationalQuestion.update',$nationalquestion->uuid) }}">
    @csrf
    @method('put')

    <div class="widget-main">
       
        <div class="tab-content padding-4">
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="date">

                    Date
                 </label>
                 <div class="col-sm-4">
                    <input class="col-xs-10 col-sm-8" type="text" 
                         name="date" id="date" value="{{ $nationalquestion->date }}">
                     @error('date')
                         <div>{{ $message }}</div>
                     @enderror
                 </div>
            </div><br><br>
            
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="question">

                    question
                 </label>
                 <div class="col-sm-4">
                    <textarea class="col-xs-10 col-sm-12" type="text" 
                         name="question" id="question" >{{ $nationalquestion->question }}</textarea>
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
                         name="reference" id="reference" >{{ $nationalquestion->reference->reference }}</textarea>
                     @error('reference')
                         <div>{{ $message }}</div>
                     @enderror
                 </div>
            </div><br><br>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="specialization_id">specialization</label>
                <div class="col-sm-4">
                    <select class="col-xs-10 col-sm-5" name="specialization_id" id="specialization_id">
                        <option value="">{{ $nationalquestion->spacialization->name }}</option>
                     @foreach ($specialization as $item)
                     <option value="{{ $item->id }}">{{ $item->name }}</option>
                     @endforeach
                       
                            
                      
                    </select>
                    @error('specialization_id')
                        <div>{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="course_id">course</label>
                <div class="col-sm-4">
                    <select class="col-xs-10 col-sm-5" name="course_id" id="course_id">
                        <option value="">{{ $nationalquestion->course->name }}</option>
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
