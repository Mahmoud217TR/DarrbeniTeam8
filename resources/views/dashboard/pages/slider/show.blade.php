
@extends('dashboard.layout.dashboard')


@section('content')
    {{-- <div id="{{route('contact.show', $contact->id)}}" class="modal fade" tabindex="-1"> --}}

    <div class="modal-content">
        <div class="modal-header no-padding">
            <div class="table-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('slider.index') }}"> <span class="white">&times; </span></a>
                </button> Results
            </div>
        </div>

        <div class="modal-body no-padding">
            <table
                class="table table-striped table-bordered table-hover
                        no-margin-bottom no-border-top">
                <thead>
                    <tr>
                      
                        <th width="100">Uuid</th>

                        <th width="100">link</th>
                        <th width="100">Image</th>
                    

                    </tr>
                <tbody>

                        <tr >
                           
                           
                            <td>{{ $slider->uuid }}</td>

                            <td>{{ $slider->link }}</td>
                                                          <td><img style="width: 90px; height: 90px;" src="{{ URL::to('/') }}/storage/slider/{{ $data->image }}"></td>
                          

                          
                  



                </tbody>
            </table>

        </div>
    </div>
    <!-- /.modal-content -->

    <!-- /.modal-dialog -->
    {{-- </div> --}}
@endsection
