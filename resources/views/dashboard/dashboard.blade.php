@extends('base')

@section('title')Dashboard @endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
@endsection

@section('content')
    <div class="container content">
        <div class="row" style="margin-left: 1rem; margin-right: 1rem;">
            @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <ul class="nav nav-tabs" id="tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button"
                    role="tab" aria-controls="user" aria-selected="true">User</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="product-tab" data-bs-toggle="tab" data-bs-target="#product" type="button"
                    role="tab" aria-controls="product" aria-selected="false">Produk</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="transaction-tab" data-bs-toggle="tab" data-bs-target="#transaction"
                    type="button" role="tab" aria-controls="transaction" aria-selected="false">Transaksi</button>
            </li>
        </ul>
        <div class="tab-content" id="tabContent">
            <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="user-tab">
                @include('dashboard.users.users')
            </div>
            <div class="tab-pane fade" id="product" role="tabpanel" aria-labelledby="product-tab">
                @include('dashboard.products.products')
            </div>
            <div class="tab-pane fade" id="transaction" role="tabpanel" aria-labelledby="transaction-tab">
                @include('dashboard.transactions.transactions')
            </div>
        </div>
    </div>

    <div class="modal" id="delete-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <form method="POST" id="modal-form">
                        {{ csrf_field() }}
                        <input type="hidden" id="modal-input-id" name="id">
                        <button type="submit" class="btn btn-danger">Ya</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var selectedTab = window.location.hash;
        if (selectedTab != "") new bootstrap.Tab($(selectedTab)).show();

        function showDeleteModal(action, id, itemName) {
            $('#modal-form').attr('action', action);
            $('#modal-input-id').attr('value', id);
            $('#modal-title').text("Apakah anda yakin ingin menghapus " + itemName + "?");
            bootstrap.Modal.getOrCreateInstance($("#delete-modal")).show();
        }
    </script>
@endsection
