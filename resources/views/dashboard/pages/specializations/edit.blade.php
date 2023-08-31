@extends('dashboard.layout.form')


@section('form_input')
    <a href="{{ route('specialization.index') }}" class="btn btn-primary btn-xs">Specialization</a>

    <form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data"
    action="{{ route('specialization.update',$specialization->uuid) }}">
    @csrf
    @method('put')

    <div class="widget-main">
       
        <div class="tab-content padding-4">
            
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="name">

                    Name
                 </label>
                 <div class="col-sm-4">
                     <input class="col-xs-10 col-sm-5" type="text" 
                         name="name" id="name" value="{{ $specialization->name }}">
                     @error('name')
                         <div>{{ $message }}</div>
                     @enderror
                 </div>
            </div><br><br>
            <div class="form-group">
                <label class="col-sm-2 control-label no-padding-right" for="collage_id">Category Name</label>
                <div class="col-sm-4">
                    <select class="col-xs-10 col-sm-5" name="collage_id" id="collage_id">
                        <option value="">{{ $specialization->collage->name }}</option>
                        @foreach ($collage as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                            
                        @endforeach
                    </select>
                    @error('collage_id')
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
