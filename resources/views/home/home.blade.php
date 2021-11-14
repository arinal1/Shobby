@extends('base')

@section('title', 'Situs Beli Perlengkapan Hobi Online')

@section('navbar')

@section('content')
    <div class="container content">
        <div class="row row-cols-4 row-cols-md-6 g-4">
            @foreach ($data as $key => $product)
                <div class="col">
                    <a class="item" href="preorder/{{ $product->id }}">
                        <div class="card h-100">
                            <img src="{{ asset($product->image) }}" class="card-img-top">
                            <div class="card-body">
                                <span class="card-text">{{ $product->name }}</span>
                                <h6 class="card-title">Rp {{ number_format($product->price, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
