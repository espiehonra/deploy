@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header"><h1>Hi {{ ucfirst($firstname) }}.<br>Your account is deactivated. If you think this is an error, please contact the web administrator.<h1></div>

            </div>
        </div>
    </div>
</div>
@endsection
