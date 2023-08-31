@extends('dashboard.layout.dashboard')

@section('content')

    <div class="row">
        
        <div class="col-xs-13">
            @if ($message = \Session::get('error'))
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @endif

            @yield('form_input')

        </div>
       
    </div>
@endsection
