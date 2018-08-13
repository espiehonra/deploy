@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($changeType==1)
                    <div class="card-header">{{ __('Change Password on First Login') }}</div>
                @else
                    <div class="card-header">{{ __('Your password has expired. You must change it before logging in.') }}</div>
                @endif
                <div class="card-body">
                    <form method="POST" action="/updatePassword" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="cpassword" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>
    
                            <div class="col-md-6">
                                <input id="cpassword" type="password" class="form-control{{ $errors->has('cpassword') ? ' is-invalid' : '' }}" name="cpassword" required>
    
                                @if ($errors->has('cpassword'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>  

                        <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>
    
                        <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" class="btn btn-primary" id="btnSavePass">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    <input type="hidden" name="empno" id="empno" value="{{ $empno }}"/>
                    </form>
                </div>
                <div class="panel-body" style="display:none" id="panelbottomMsg">
                </div>            
            </div>
        </div>
    </div>
</div>

@endsection
