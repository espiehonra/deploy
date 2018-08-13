@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="empno" class="col-md-4 col-form-label text-md-right">{{ __('Employee Number') }}</label>

                            <div class="col-md-6">
                                <input id="empno" type="text" class="form-control{{ $errors->has('empno') ? ' is-invalid' : '' }}" name="empno" value="{{ old('empno') }}" required autofocus>

                                @if ($errors->has('empno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('empno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control{{ $errors->has('firstname') ? ' is-invalid' : '' }}" name="firstname" value="{{ old('firstname') }}" required autofocus>

                                @if ($errors->has('firstname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="middlename" class="col-md-4 col-form-label text-md-right">{{ __('Middle Name') }}</label>

                            <div class="col-md-6">
                                <input id="middlename" type="text" class="form-control{{ $errors->has('middlename') ? ' is-invalid' : '' }}" name="middlename" value="{{ old('middlename') }}" required autofocus>

                                @if ($errors->has('middlename'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('middlename') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contactNo" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">
                                <input id="contactNo" type="text" class="form-control{{ $errors->has('contactNo') ? ' is-invalid' : '' }}" name="contactNo" value="{{ old('contactNo') }}" required autofocus>

                                @if ($errors->has('contactNo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contactNo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="userLevel" class="col-md-4 col-form-label text-md-right">{{ __('User Level') }}</label>

                            <div class="col-md-6">
                                <select id="userLevel" class="form-control{{ $errors->has('userLevel') ? ' is-invalid' : '' }}" name="userLevel" value="{{ old('userLevel') }}" required>
                                    <option value="1">Super Admin</option>
                                    <option value="2">Admin</option>
                                    <option value="3">User</option>
                                </select>

                                @if ($errors->has('userLevel'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('userLevel') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="deptId " class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                <select id="deptId" class="form-control{{ $errors->has('deptId') ? ' is-invalid' : '' }}" name="deptId" value="{{ old('deptId') }}" required>
                                    <option value="1">Operations</option>
                                </select>

                                @if ($errors->has('deptId'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('deptId') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="regionId" class="col-md-4 col-form-label text-md-right">{{ __('Region') }}</label>
    
                                <div class="col-md-6">
                                    <select id="regionId" class="form-control{{ $errors->has('regionId') ? ' is-invalid' : '' }}" name="regionId" value="{{ old('regionId') }}" required>
                                        <option value="1">Operations</option>
                                    </select>
    
                                    @if ($errors->has('regionId'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('regionId') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" disabled>

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" disabled>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        <input type="hidden" id="isLogin " value="1" name="isLogin">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
