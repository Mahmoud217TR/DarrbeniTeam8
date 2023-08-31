@extends('dashboard.layout.dashboard')


@section('content')
    {{-- <div id="{{route('contact.show', $contact->id)}}" class="modal fade" tabindex="-1"> --}}

    <div class="modal-content">
        <div class="modal-header no-padding">
            <div class="table-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('collage.index') }}"> <span class="white">&times; </span></a>
                </button> Results for {{ $Collage->name }}
            </div>
        </div>

        <div class="modal-body no-padding">
            <table
                class="table table-striped table-bordered table-hover
                        no-margin-bottom no-border-top">
                <thead>
                    <tr>
                        <th width="100" class="hidden-480">Image</th>
                        <th width="100">Uuid</th>

                        <th width="100">Name</th>
                        <th width="100">Category Name</th>
                       
                    </tr>
                </thead>

                <tbody>
                    <tr>

                        <td><img style="width: 90px; height: 90px;" src="{{ URL::to('/') }}/storage/Collage/{{ $data->image }}"></td>
                        <td>{{ $Collage->uuid }}</td>
                        <td>{{ $Collage->name }}</td>
                        <td>{{ $Collage->category->name}}</td>
                      
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
    <!-- /.modal-content -->

    <!-- /.modal-dialog -->
    {{-- </div> --}}
@endsection
