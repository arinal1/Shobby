@extends('base')

@section('title')
    Pre Order {{ $data->name }}
@endsection

@section('login-modal-title', 'Login untuk melanjutkan')

@section('content')
    <div class="container content">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset($data->image) }}" class="rounded product-preview">
            </div>
            <div class="col-md-5 preorder-detail">
                <p class="preorder-name">{{ $data->name }}</p>
                <p class="preorder-publisher">by {{ $data->publisher }}</p>
                <span class="preorder-price">Rp {{ number_format($data->price, 0, ',', '.') }}</span>
                <span>/ {{ $data->volume }} volume</span>
                <p class="preorder-status text-success">{{ $data->status }}</p>
                <p class="preorder-description">{{ $data->description }}</p>
            </div>
            @if (Auth::user() == null || Auth::user()->hasRole('user'))

                <div class="col-md-3">
                    <div class="card order">
                        <div class="card-header">
                            <b>Pesan sekarang!</b>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('preorder.checkout') }}" method="post">
                                @csrf
                                <input name="id" value="{{ $data->id }}" hidden>
                                <div class="mb-2">
                                    <input name="qty" class="form-control" placeholder="Jumlah" type="number" min="1"
                                        id="qty" required>
                                </div>
                                <div class="mb-2">
                                    <select class="form-select" aria-label="Default select example"
                                        placeholder="Opsi Pre Order" name="option">
                                        <option value="Pre Order By SEA">Pre Order By SEA</option>
                                        <option value="Pre Order By AIR">Pre Order By AIR</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <span class="preorder-subtotal">Sub Total:</span>
                                    <b id="subtotal">Rp 0</b>
                                </div>
                                <div class="d-grid">
                                    @if (Auth::check())
                                        <button type="submit" class="btn btn-primary">Pesan</button>
                                    @else
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#loginModal">Pesan</button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("#qty").bind('keyup input', function() {
            var qty = $(this).val();
            var subtotal = qty * {{ $data->price }};
            $("#subtotal").text("Rp " + subtotal.toLocaleString('ID'));
        });
    </script>
@endsection
