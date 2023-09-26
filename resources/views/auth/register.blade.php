@extends('layouts.index')

@section('content')
<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"  style="border-radius: 20px">
                <h1 class="card-header" style="font-size: 30px"><strong>Account Registration</strong></h1>
                <hr>
                <div class="card-body" style="font-size: 15px">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                    
                        <!-- Profile Image -->
                        <div class="row mb-3"  style="justify-content: center">
                            <label for="ProfileImage" class="col-md-4 col-form-label text-md-end"> <i class="fas fa-image"></i>  {{ __('Profile Image') }}</label>
                            <div class="col-md-6">
                                <input id="ProfileImage" type="file" class="form-control @error('ProfileImage') is-invalid @enderror" name="ProfileImage" accept="image/*">
                                @error('ProfileImage')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- First Name -->
                        <div class="row mb-3"  style="justify-content: center">
                            <label for="FirstName" class="col-md-4 col-form-label text-md-end"> <i class="fas fa-user"></i>  {{ __('First Name') }}</label>
                            <div class="col-md-6">
                                <input id="FirstName" type="text" class="form-control @error('FirstName') is-invalid @enderror" name="FirstName" value="{{ old('FirstName') }}" required autocomplete="FirstName" autofocus>
                                @error('FirstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Last Name -->
                        <div class="row mb-3"  style="justify-content: center">
                            <label for="LastName" class="col-md-4 col-form-label text-md-end"> <i class="fas fa-user"></i>  {{ __('Last Name') }}</label>
                            <div class="col-md-6">
                                <input id="LastName" type="text" class="form-control @error('LastName') is-invalid @enderror" name="LastName" value="{{ old('LastName') }}" required autocomplete="LastName" autofocus>
                                @error('LastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3"  style="justify-content: center">
                            <label for="MobileNum" class="col-md-4 col-form-label text-md-end"> <i class="fas fa-mobile"></i>  {{ __('Mobile Number') }}</label>
                            <div class="col-md-6">
                                <input id="MobileNum" type="text" class="form-control @error('MobileNum') is-invalid @enderror" name="MobileNum" value="{{ old('MobileNum') }}" required autocomplete="MobileNum">
                                @error('MobileNum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3" style="justify-content: center">
                            <label for="AccountType" class="col-md-4 col-form-label text-md-end"><i class="fas fa-user-tag"></i> {{ __('Account Type') }}</label>

                            <div class="col-md-6">
                                <select id="AccountType" class="form-control @error('AccountType') is-invalid @enderror" name="AccountType" required> 
                                    <option value="">--Select Account Type--</option>
                                    <option value="Manager">Manager</option>
                                    <option value="Clerk">Clerk</option>
                                    <option value="Driver">Driver</option>
                                    <option value="Mechanic">Mechanic</option>
                                </select>

                                @error('AccountType')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3"  style="justify-content: center">
                            <label for="Email" class="col-md-4 col-form-label text-md-end"><i class="fas fa-envelope"></i> {{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="Email" type="email" class="form-control @error('Email') is-invalid @enderror" name="Email" value="{{ old('Email') }}" required autocomplete="Email">
                                @error('Email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Password -->
                        <div class="row mb-3"  style="justify-content: center">
                            <label for="password" class="col-md-4 col-form-label text-md-end"><i class="fas fa-lock"></i> {{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    
                        <!-- Confirm Password -->
                        <div class="row mb-2"  style="justify-content: center">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end" ><i class="fas fa-lock"></i> {{ __('Confirm Password') }}</label>
                            <div class="col-md-6" >
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                    
                        <!-- Register Button -->
                        <div class="row mb-0" style="justify-content: center">
                            <div class="col-md-6 offset-md-4" style="font-size: 17px">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        
                    </form>       
                    <br>
                    <div class="text-center">Have an account? <a href="{{ route('login') }}">Login</a></div>      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
