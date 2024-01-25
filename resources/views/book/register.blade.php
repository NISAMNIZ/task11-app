@extends('layouts.app')
@section('content')
<style>
    body{
        background-image: url('book3.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    .register{
        background-image: url('book8.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
    
</style>
<a href="{{ route('home.book') }}" class="btn btn-primary float-right " style="margin-left:1200px;">Home</a>
    <section class="vh-100 bg-image" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card register" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Register a Book</h2>
                                @if(session()->has('message'))
                                    <p class="alert alert-success">{{ session()->get('message') }}</p>
                                @endif
                                <form action="{{route('regsave.book')}}" method="post">
                                    @csrf

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example1cg">Book Name</label>
                                        <input type="text" id="form3Example1cg" name="name" class="form-control form-control-lg" >
                                        @error('name')
                                        <div class="alert alert-danger" style="margin-top: 10px;">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3cg">Author Name</label>
                                        <input type="text" id="form3Example3cg" name="author" class="form-control form-control-lg">
                                        @error('author')
                                        <div class="alert alert-danger" style="margin-top: 10px;">{{ $message }}</div>
                                        @enderror

                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cg">Content</label>
                                        <input type="textarea" id="form3Example4cg" name="content" class="form-control form-control-lg" >
                                        @error('content')
                                        <div class="alert alert-danger" style="margin-top: 10px;">{{ $message }}</div>
                                        @enderror

                                    </div>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body mb-3">Register</button>
                                    </div>

                                    

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
