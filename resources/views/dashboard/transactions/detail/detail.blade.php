@extends('base')

@section('title')
    @if (session('operation') == 'add')
        Buat Transaksi
    @else
        Edit Transaksi #{{ $data->id }}
    @endif
@endsection

@section('content')
    <div class="container content">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Form @if (session('operation') == 'add')Buat @else Edit @endif Transaksi</h3>
            </div>
            <form action="{{ route('transaction.save') }}" method="post">
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
                            <label class="form-label"><strong>ID Produk</strong></label>
                            <input type="text" name="product_id" class="form-control" placeholder="ID Produk" required
                                value="{{ $data?->product_id }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><strong>ID User</strong></label>
                            <input type="text" name="user_id" class="form-control" placeholder="ID User" required
                                value="{{ $data?->user_id }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><strong>Jumlah</strong></label>
                            <input type="number" min="0" name="qty" class="form-control" placeholder="Jumlah" required
                                value="{{ $data?->qty }}">
                        </div>
                        <div class="mb-4">
                            <label class="form-label"><strong>Opsi</strong></label>
                            <select class="form-select" aria-label="Opsi" placeholder="Opsi" name="option">
                                <option value="Pre Order By SEA" @if ($data?->status == 'Pre Order By SEA') selected @endif>Pre Order By SEA</option>
                                <option value="Pre Order By AIR" @if ($data?->status == 'Pre Order By AIR') selected @endif>Pre Order By AIR</option>
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
