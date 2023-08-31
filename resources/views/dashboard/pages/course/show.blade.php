
@extends('dashboard.layout.dashboard')


@section('content')
    {{-- <div id="{{route('contact.show', $contact->id)}}" class="modal fade" tabindex="-1"> --}}

    <div class="modal-content">
        <div class="modal-header no-padding">
            <div class="table-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('course.index') }}"> <span class="white">&times; </span></a>
                </button> Results for {{ $course->name }}
            </div>
        </div>

        <div class="modal-body no-padding">
            <table
                class="table table-striped table-bordered table-hover
                        no-margin-bottom no-border-top">
                <thead>
              

                    <th width="100">Uuid</th>

                    <th width="100">name</th>
                    <th width="100">Specialization</th>
                 

                </tr>
                </thead>

                <tbody>
                    <tr>

                        <td>{{ $course->uuid }}</td>

                        <td>{{ $course->name }}</td>
                        <td>
                            
                                {{ $course->spacialization->name }}
                         
                              

                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
    <!-- /.modal-content -->

    <!-- /.modal-dialog -->
    {{-- </div> --}}
@endsection
