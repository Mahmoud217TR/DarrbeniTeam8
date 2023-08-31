@extends('dashboard.layout.dashboard')


@section('content')
    {{-- <div id="{{route('contact.show', $contact->id)}}" class="modal fade" tabindex="-1"> --}}

    <div class="modal-content">
        <div class="modal-header no-padding">
            <div class="table-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <a href="{{ route('courseQuestion.index') }}"> <span class="white">&times; </span></a>
                </button> Results for {{ $courseQuestion->question }}
            </div>
        </div>

        <div class="modal-body no-padding">
            <table
                class="table table-striped table-bordered table-hover
                        no-margin-bottom no-border-top">
                <thead>
                    <tr>

                        <th width="100">Uuid</th>
                        <th width="100">Course</th>
                        <th width="100">Question</th>
                        <th width="100">Answer</th>
                        <th width="100">Reference</th>



                    </tr>
                </thead>

                <tbody>
                    <tr>


                        <td>{{ $courseQuestion->uuid }}</td>
                        <td>{{ $courseQuestion->course->name }}</td>
                        <td>{{ $courseQuestion->question }}</td>
                        <td>
                            <ul>
                                @foreach ($courseQuestion->answers as $item)
                                    <li>
                                        {{ $item->answer }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            {{ $courseQuestion->reference->reference }}
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
