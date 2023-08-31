@extends('dashboard.layout.dashboard')


@section('content')

    <!-- div.dataTables_borderWrap -->
    <div class="tab-content padding-4">
      
                <div class="widget-toolbar">

                    <div class="d-none d-md-block">


                        <a href="{{ route('nationalQuestion.index') }}" class="btn btn-primary btn-xs"><i
                                class="ace-icon fa fa-undo bigger-120"></i>Back</a>

                    </div>
                </div>

                <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="100" class="center">
                                <label class="pos-rel">
                                    <input type="checkbox" class="ace" />
                                    <span class="lbl"></span>
                                </label>
                            </th>
                            <th width="100">Uuid</th>

                            <th width="100">Question</th>
                            <th width="100">Answer</th>
                            {{-- <th width="100">Reference</th> --}}
                            <th width="130">Actions</th>
        
                        </tr>
                    <tbody>
        
                        @foreach ($question as $data)
                            <tr class="collageRow{{ $data->id }}">
                                <td class="center">
                                    <label class="pos-rel">
                                        <input type="checkbox" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
        
                                <td>{{ $data->uuid }}</td>
        
                                <td>{{ $data->question }}</td>
                               
                                <td>
                                @foreach ($data->answers as $Answer)
                                    
                                        <ul>
                                            <li>{{ $Answer->answer }}</li>
                                        </ul>
                                    
                                @endforeach
                            </td>
                            {{-- <td>
                                {{ $data->references->reference }}
                            </td> --}}
                                <td>
                                    <a class="btn btn-xs btn-info" href="{{ route('nationalQuestion.restore', $data->uuid) }}">
                                        <i class="ace-icon fa fa-undo bigger-120"> </i>
                                    </a>
                                    <a class="btn btn-xs btn-danger" href="{{ route('nationalQuestion.finaldelete', $data->uuid) }}">
                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                </td>

                            </tr>
                        @endforeach



                    </tbody>
                </table>
            </div>
       
    </div>
@endsection
