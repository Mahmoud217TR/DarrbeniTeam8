@extends('dashboard.layout.dashboard')


@section('content')
    {{-- <div id="{{route('contact.show', $contact->id)}}" class="modal fade" tabindex="-1"> --}}

    <div class="modal-content">
        <div class="modal-header no-padding">
            <div class="table-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('nationalQuestion.index') }}"> <span class="white">&times; </span></a>
                </button> Results for {{ $question->question }}
            </div>
        </div>

        <div class="modal-body no-padding">
            <table
                class="table table-striped table-bordered table-hover
                        no-margin-bottom no-border-top">
                <thead>
                    <tr>

                        <th width="100">Uuid</th>
                        <th width="100">Specialization</th>
                        <th width="100">Date</th>
                        <th width="100">Question</th>
                        <th width="100">Answer</th>
                        <th width="100">Reference</th>



                    </tr>
                </thead>

                <tbody>
                    <tr>


                        <td>{{ $question->uuid }}</td>
                        <td>
                            
                            {{ $question->spacialization->name }}
                     
                          

                    </td>
                        <td>{{ $question->date }}</td>
                        <td>{{ $question->question }}</td>
                        <td>
                            <ul>
                                @foreach ($question->answers as $item)
                                    <li>
                                        {{ $item->answer }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            {{ $question->reference->reference }}
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
