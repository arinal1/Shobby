@extends('base')

@section('title')Daftar Transaksi @endsection

@section('content')
    <div class="container content">
        @if ($data == null)
            <p class="text-center" style="margin-top:10rem;">
                <b>Anda Belum Memiliki Riwayat Transaksi</b>
            </p>
        @else
            <table class="table table-hover">
                <thead>
                    <tr class="table-primary">
                        <th>ID Transaksi</th>
                        <th>Produk</th>
                        <th>Opsi</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                        <th>Waktu Pemesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr class="table-default">
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->option }}</td>
                            <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>Rp {{ number_format($item->product->price * $item->qty, 0, ',', '.') }}</td>
                            <td>{{ $item->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
