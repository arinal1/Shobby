@extends('base')

@section('title')
    @if (session('operation') == 'add')
        Tambah User
    @else
        Edit User {{ $data->name }}
    @endif
@endsection

@section('content')
    <div class="container content">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Form @if (session('operation') == 'add')Tambah @else Edit @endif User</h3>
            </div>
            <form action="{{ route('user.save') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row" style="margin-left: 1rem; margin-right: 1rem;">
                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif
                    </div>
                    <div class="row" style="margin-left: 1rem; margin-right: 1rem;">
                        <div class="mb-4">
                            <label class="form-label"><strong>ID</strong></label>
                            <input type="text" name="id" class="form-control" placeholder="ID" @if ($data != null && $data->id != '') readonly @endif
                                value="{{ $data?->id }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><strong>Nama</strong></label>
                            <input type="text" name="name" class="form-control" placeholder="Nama" required
                                value="{{ $data?->name }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><strong>Email</strong></label>
                            <input type="email" name="email" class="form-control" placeholder="Email" required
                                value="{{ $data?->email }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><strong>Password</strong></label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><strong>Role</strong></label>
                            <select class="form-select" aria-label="Role" placeholder="Role" name="role">
                                <option value="owner" @if ($data?->role == 'owner') selected @endif>Owner</option>
                                <option value="backoffice" @if ($data?->role == 'backoffice') selected @endif>Back Office</option>
                                <option value="user" @if ($data?->role == 'user') selected @endif>User</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex flex-row" style="justify-content: flex-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
