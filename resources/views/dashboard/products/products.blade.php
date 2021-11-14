@if ($products == null || $products->isEmpty())
    <p class="text-center" style="margin:8rem;">
        <b>Tidak ada data produk</b>
    </p>
@else
    <table class="table table-hover">
        <thead>
            <tr class="table-defaul">
                <th>ID</th>
                <th>Gambar</th>
                <th>Produk</th>
                <th>Volume</th>
                <th>Deskripsi</th>
                <th>Publisher</th>
                <th>Status</th>
                <th>Harga</th>
                <th>Waktu Terdaftar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="scrollable">
            @foreach ($products as $product)
                <tr class="table-default scrollable">
                    <td>{{ $product->id }}</td>
                    <td style="max-width: 80px;">
                        @if ($product->image != '')
                            <img src="{{ asset($product->image) }}" class="img-fluid img-product-thumbnail">
                        @else
                            <img src="{{ asset('img/card-image.svg') }}" class="img-fluid img-product-thumbnail">
                        @endif
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->volume }}</td>
                    <td>
                        <p class="preorder-description">{{ $product->description }}</p>
                    </td>
                    <td>{{ $product->publisher }}</td>
                    <td>{{ $product->status }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->created_at }}</td>
                    <td>
                        <button class="btn btn-danger bi bi-trash"
                            onclick="showDeleteModal('{{ route('product.delete') }}','{{ $product->id }}','{{ 'Produk ' . $product->name }}')"></button>
                        <a class="btn btn-success bi bi-pencil-square" style="margin-top: 10px;"
                            href="{{ route('product.detail', [$product->id]) }}"></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
<div class="row justify-content-evenly" style="padding-top: 2rem; margin: 0;">
    <div class="col text-center">
        <a href="{{ route('product.detail') }}" class="btn btn-success" style="width: 100%;">Tambah Produk</a>
    </div>
</div>
