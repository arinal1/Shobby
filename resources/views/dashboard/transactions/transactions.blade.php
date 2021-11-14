@if ($transactions == null || $transactions->isEmpty())
    <p class="text-center" style="margin:8rem;">
        <b>Tidak ada data transaksi</b>
    </p>
@else
    <table class="table table-hover">
        <thead>
            <tr class="table-defaul">
                <th>ID Transaksi</th>
                <th>ID Produk</th>
                <th>Produk</th>
                <th>ID User</th>
                <th>User</th>
                <th>Opsi</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Sub Total</th>
                <th>Waktu Pemesanan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="scrollable">
            @foreach ($transactions as $item)
                <tr class="table-default scrollable">
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product_id }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->user_id }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->option }}</td>
                    <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->product->price * $item->qty, 0, ',', '.') }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>
                        <button class="btn btn-danger bi bi-trash"
                            onclick="showDeleteModal('{{ route('transaction.delete') }}','{{ $item->id }}','{{ 'Transaksi #' . $item->id }}')"></button>
                        <a class="btn btn-success bi bi-pencil-square"
                            href="{{ route('transaction.detail', [$item->id]) }}"></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
<div class="row justify-content-evenly" style="padding-top: 2rem; margin: 0;">
    <div class="col text-center">
        <a href="{{ route('transaction.detail') }}" class="btn btn-success" style="width: 100%;">Buat Transaksi</a>
    </div>
</div>
