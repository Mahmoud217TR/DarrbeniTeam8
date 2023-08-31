
@extends('dashboard.layout.dashboard')


@section('content')
    {{-- <div id="{{route('contact.show', $contact->id)}}" class="modal fade" tabindex="-1"> --}}

    <div class="modal-content">
        <div class="modal-header no-padding">
            <div class="table-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('courseAnswers.index') }}"> <span class="white">&times; </span></a>
                </button> Results for {{ $courseAnswer->answer }}
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
                    <th width="100">Question</th>
                   

                </tr>
                </thead>

                <tbody>
                    <tr>

                        <td>{{ $courseAnswer->uuid }}</td>

                        <td>{{ $courseAnswer->answer }}</td>
                        <td>
                            @foreach ($courseAnswer->questions as $question)
                            
                            <ul>
                                <li>{{ $question->question }}</li>
                            </ul>
                        
                    @endforeach
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
