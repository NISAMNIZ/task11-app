@extends('layouts.app')
@section('content')
<style>
    body{
        background-image: url('book4.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>
    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            @if(session()->has('message'))
                <p class="alert alert-success">{{ session()->get('message') }}</p>
            @endif
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <h4 class="fw-bold mb-2 text-uppercase">LOGIN FORM</h4>
                            <form action="{{ route('dologin.book') }}" method="post">
                                @csrf
                                <div class="form-outline form-white mb-3">
                                    <p class="text-white-50 mb-5">Please enter your login and password!</p>
                                    <i class="fas fa-user"></i><br>
                                    <input type="text" placeholder="Name" name="name" id="name" class="form-control" required>
                                </div><br>
                                <div class="form-outline form-white mb-4">
                                    <i class="fas fa-lock"></i><br>
                                    <input type="password" placeholder="Password" name="password" id="password" class="form-control" required>
                                </div>
                                {{--                                <div class="pass"><a href="#">Forgot password?</a></div><br>--}}
                                <div class="row button" style="margin-top: 20px">
                                    <button type="submit" class="btn btn-outline-success" value="Login" id="btn">Login</button>
                                </div>
                                {{-- <div class="signup-link mt-2">Not a member? <a style="text-decoration: none" href="{{ route('register.book') }}">Signup now</a></div> --}}
                            </form>
                            @error('name')
                            {{-- Display validation error messages --}}
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
