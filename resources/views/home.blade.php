@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Status') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        
                    {{ __('Pomyślnie zalogowano') }}
                    <a class="btn btn-primary" href="/" style="float: right;">Wróć do strony głównej</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
