@extends('layouts.app')
@section('content')
<style>
    body{
        background-image: url('book2.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>
<a href="{{ route('home.book') }}" class="btn btn-primary float-right " style="margin-left:1400px;">Home</a>
    <table class="table mt-4 table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Book Name</th>
            <th scope="col">Allocated Count</th>
        </tr>
        </thead>
        @foreach($books as $book)
            <tbody>
                <tr>
                    <th scope="row">{{ ($books->currentpage() - 1) * $books->perpage() + $loop->index + 1 }}</th>
                    <td>{{ $book->name }} </td>
                    <td>{{ $book->customers->count() }}</td>
                </tr>
            </tbody>
        @endforeach
    </table>
    <div class="mt-3">
        {{ $books->links() }}
    </div>
    <div>
        

@endsection
