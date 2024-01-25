@extends('layouts.app')
@section('content')
<style>
    body{
        background-image: url('book.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>
<div class="container my-5">
    <h1 class="text-light">Books</h1>
    <div>
        @error('name')
        <div class="alert alert-danger" style="margin-top: 10px;">{{ $message }}</div>
        @enderror
        @error('email')
        <div class="alert alert-danger" style="margin-top: 10px;">{{ $message }}</div>
        @enderror
    </div>
    @if(session()->has('message'))
        <p class="alert alert-success">{{ session()->get('message') }}</p>
    @endif
    <div class="d-flex justify-content-end">
        <a href="{{ route('register.book') }}" class="btn btn-success" style="margin-right: 10px;">Register a Book</a>
        <a href="{{ route('logout') }}" class="btn btn-danger" style="margin-right: 10px;">Logout</a>
    </div>
    
    <div class="col-md-6">
        <div class="form-group">
            
          <form action="{{ route('home.book') }}" method="get">
            <div class="input-group">
                <input class="form-control" name="search" placeholder="Search" value="{{ isset($search) ? $search:''}}">
                <button  type="submit" class="btn btn-primary" >Search
                  </button>
            </div> 
          </form>
      </div>
      </div>
      

    <table class="table mt-4 table-hover">
        <thead class="thead-dark ">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Book Name</th>
                <th scope="col">Author Name</th>
                <th scope="col">Content</th>
                <th scope="col">Allocate</th>
            </tr>
        </thead>
        @foreach($books as $book)
            <tbody>
                <tr>
                    <th scope="row">{{ ($books->currentpage() - 1) * $books->perpage() + $loop->index + 1 }}</th>
                    <td>{{ $book->name }} </td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->content }}</td>
                    <td>
                        <button class='btn btn-warning btn-sm modalButton' data-toggle="modal" data-target="#modalCreate" data-id="{{ $book->id }}" data-name="{{ $book->name }}">Allocate</button>
                    </td>
                </tr>
            </tbody>
        @endforeach
    </table>
    
    <div class="mt-3">
        {{ $books->links() }}
    </div>
    <div>
        <a href="{{ route('count.book') }}" class='btn btn-primary text-center '>View count</a>
    </div>
</div>


<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            
            <div class="modal-header text-center bg-primary text-white">
                <h4 class="modal-title w-100 font-weight-bold ">Subscribe</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- @if(session()->has('message'))
            <p class="alert alert-success">{{ session()->get('message') }}</p>
            @endif --}}
            <div class="modal-body mx-3">
                <form action="{{ route('store.book') }}" method="POST" id="allocateForm">
                    @csrf
                    <input type="hidden" id="bookId" name="bookId" >

                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <label data-error="wrong" data-success="right" for="form3">Your name</label>
                        <input type="text" id="form3" name="name" class="form-control validate">
                        <div class="alert alert-danger" style="margin-top: 10px;" id="nameError"></div>
                    </div>

                    <div class="md-form mb-4">
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <label data-error="wrong" data-success="right" for="form2">Your email</label>
                        <input type="email" id="form2" name="email" class="form-control validate">
                        <div class="alert alert-danger" style="margin-top: 10px;" id="emailError"></div>
                    </div>

                    <div class="modal-footer d-flex justify-content-center ">
                        <button type="button" id="sendButton" class="btn btn-primary">Send <i class="fas fa-paper-plane-o ml-1"></i></button>
                    </div>
                    <div id="errorMessages" class="alert alert-danger" style="display: none;"></div>
                    <div class="alert alert-success" style="display: none;" id="successMessage"></div>
<div class="alert alert-danger" style="display: none;" id="errorMessage"></div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


<script>
    $(document).ready(function () {

        $('.modalButton').on('click', function (e) {
            var bookId = $(this).attr('data-id');
            console.log('Book ID:', bookId);
            $('#bookId').val(bookId);
            $('#nameError').hide();
            $('#emailError').hide();
            $('#errorMessages').hide();
            $('#successMessage').hide(); // Hide success message
            $('#errorMessage').hide();   // Hide error message
            
        });

        // Handle form submission
        $('#sendButton').click(function (e) {
            e.preventDefault(); // Prevent the default form submission
            var bookId = $('#bookId').val();
            var name = $('#form3').val();
            var email = $('#form2').val();

            console.log('Submitting:', { bookId, name, email });


            $.ajax({
                type: 'POST',
                url: '{{ route("store.book") }}',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'name': $('#form3').val(),
                    'email': $('#form2').val(),
                    'bookId': $('#bookId').val(),
                },
                success: function (response) {
                    // Handle success, e.g., show a success message
                    $('#nameError').hide();
                    $('#emailError').hide();
                    $('#errorMessages').hide();
                    $('#successMessage').html('Subscription successful.').show();
                    $('#errorMessage').hide();  
                    $('#modalCreate').modal('hide');

                    //clear the form
                    $('#form3').val('');
                    $('#form2').val('');
                },
                error: function (xhr, status, error) {
                    var errors = xhr.responseJSON.errors;
                    $('#nameError').html(errors.name ? errors.name[0] : '').toggle(errors.name !== undefined);
                    $('#emailError').html(errors.email ? errors.email[0] : '').toggle(errors.email !== undefined);
                    $('#errorMessages').html('Subscription failed. Please fix the following errors.').show();
                }
            });
        });
    });
</script>


@endsection
