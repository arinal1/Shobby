@extends('base')

@section('title', 'Login')

@section('navbar')
@endsection

@section('content')
    <div class="container-fluid" style="height:100vh;display:flex">
        <div class="col-md-5 offset-md-5" style="margin:auto">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Form Login</h3>
                </div>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="card-body">
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                        <div class="mb-4">
                            <label for=""><strong>Email</strong></label>
                            <input type="text" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="mb-4">
                            <label for=""><strong>Password</strong></label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="card-footer d-flex flex-row" style="justify-content: flex-end">
                        <button type="submit" class="btn btn-primary">Log In</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
