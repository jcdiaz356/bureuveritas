{{--@extends('layouts.app')--}}
@extends('layouts.theme.app')

@section('content')
{{--<div class="container">--}}
    <div class="row">
        <div class="col-md-12">
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                    {{ __('You are logged in!') }}--}}

{{--                    dfgdfg--}}
{{--                </div>--}}
{{--            </div>--}}

            <div>

                @if (Auth::user()->id == 1  || Auth::user()->id == 10 )

                    <iframe id="inlineFrameExample"
                            title="Inline Frame Example"
                            width="100%"
                            height="850"
                            src="https://datastudio.google.com/embed/reporting/89858156-421c-452a-8c9f-2289c22e72de/page/0NhqC">
                    </iframe>

                @else

                    <h3 class="p-5">Usuario no autorizado</h3>

                @endif

            </div>
        </div>
    </div>
{{--</div>--}}
@endsection
