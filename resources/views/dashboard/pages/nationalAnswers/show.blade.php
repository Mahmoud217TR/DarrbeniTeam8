@extends('dashboard.layout.dashboard')


@section('content')
    {{-- <div id="{{route('contact.show', $contact->id)}}" class="modal fade" tabindex="-1"> --}}

    <div class="modal-content">
        <div class="modal-header no-padding">
            <div class="table-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('nationalAnswer.index') }}"> <span class="white">&times; </span></a>
                </button> Results for {{ $answer->answer }}
            </div>
        </div>

        <div class="modal-body no-padding">
            <table
                class="table table-striped table-bordered table-hover
                        no-margin-bottom no-border-top">
                <thead>
                    <tr>
                        <th width="100">Uuid</th>

                        <th width="100">Answer</th>
                        <th width="100">Status</th>
                        <th width="100">Question</th>


                    </tr>
                <tbody>


                    <tr >
                      

                        <td>{{ $answer->uuid }}</td>

                        <td>{{ $answer->answer }}</td>
                        <td>{{ $answer->status }}</td>
                        <td>
                            {{ $answer->NationalQuestion->question }}


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
