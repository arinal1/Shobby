@extends('base')

@section('title')
    @if (session('operation') == 'add')
        Tambah Produk
    @else
        Edit {{ $data->name }}
    @endif
@endsection

@section('content')
    <div class="container content">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Form @if (session('operation') == 'add')Tambah @else Edit @endif Produk</h3>
            </div>
            <form action="{{ route('product.save') }}" method="post" enctype="multipart/form-data">
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
                        <div class="col-6 divider-vertical" style="padding-right: 2rem;">
                            <div class="mb-4">
                                <label class="form-label"><strong>ID</strong></label>
                                <input type="text" name="id" class="form-control" placeholder="ID"
                                    @if ($data != null && $data->id != '') readonly @endif value="{{ $data?->id }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"><strong>Nama</strong></label>
                                <input type="text" name="name" class="form-control" placeholder="Nama" required
                                    value="{{ $data?->name }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"><strong>Volume</strong></label>
                                <input type="number" min="0" name="volume" class="form-control" placeholder="Volume"
                                    required value="{{ $data?->volume }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"><strong>Deskripsi</strong></label>
                                <textarea type="text" name="description" class="form-control" placeholder="Deskripsi"
                                    required style="height: 12rem;">{{ $data?->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-6" style="padding-left: 2rem;">
                            <div class="mb-4">
                                <label class="form-label"><strong>Publisher</strong></label>
                                <input type="text" name="publisher" class="form-control" placeholder="Publisher" required
                                    value="{{ $data?->publisher }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"><strong>Status</strong></label>
                                <select class="form-select" aria-label="Status" placeholder="Status" name="status">
                                    <option value="Pre Order" @if ($data?->status == 'Pre Order') selected @endif>Pre Order</option>
                                    <option value="Ready" @if ($data?->status == 'Ready') selected @endif>Ready</option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="form-label"><strong>Harga</strong></label>
                                <input type="number" name="price" class="form-control" placeholder="Harga" min="0"
                                    required value="{{ $data?->price }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label"><strong>Gambar</strong></label>
                                <br>
                                @if ($data != null && $data->image != '')
                                    <img class="rounded img-product-thumbnail" src="{{ asset($data->image) }}">
                                @else
                                    <img class="rounded img-product-thumbnail" src="{{ asset('img/card-image.svg') }}">
                                @endif
                                <input class="form-control" type="file" name="image" id="image"
                                    accept=".jpg, .JPG, .png, .PNG, .jpeg, .JPEG, .svg, .SVG">
                            </div>
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

@section('script')
    <script>
        function display(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    $('.img-product-thumbnail').attr('src', event.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#image").change(function() {
            display(this);
        });
    </script>
@endsection
