@extends('dashboard.layout.dashboard')


@section('content')
   
       
            <div class="modal-content">
                <div class="modal-header no-padding">
                    <div class="table-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" >
                          <a href="{{ route('category.index') }}"> <span class="white">&times; </span></a>
                        </button> Results for {{$category->name}}
                    </div>
                </div>

                <div class="modal-body no-padding">
                    <table
                        class="table table-striped table-bordered table-hover
                        no-margin-bottom no-border-top">
                        <thead>
                            <tr>
                               
                                <th>Uuid</th>
                                <th>Name</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                
                                <td>{{ $category->uuid }}</td>
                                <td>{{ $category->name }}</td>

                                
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.modal-content -->
   
        <!-- /.modal-dialog -->
    {{-- </div> --}}
@endsection
