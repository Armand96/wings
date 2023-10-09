@extends('client.master_client')

@section('content')
    <div class="container">

        <div class="row mt-5">
            <div class="col"></div>
            <div class="col-6">
                <ul class="card p-3 pr-0">
                    @foreach ($products as $item)
                        <div class="row my-2">
                            <div class="col-4 d-flex justify-content-center">
                                <img src="{{ asset('/img/wings.png') }}" alt="gambar" class="img-thumbnail" width="100px">
                            </div>
                            <div class="col-3">
                                <p class="p-0 m-0">{{ $item->product_name }}</p>
                                @if ($item->discount <= 0)
                                    <p class="p-0 m-0">Rp. {{ number_format($item->price, 0, ',', '.') }},-</p>
                                @else
                                    <small>
                                        <del class="p-0 m-0">Rp. {{ number_format($item->price, 0, ',', '.') }},-</del>
                                    </small>
                                    <p class="p-0 m-0">Rp.
                                        {{ number_format($item->price - ($item->price * $item->discount) / 100, 0, ',', '.') }},-
                                    </p>
                                @endif
                            </div>
                            <div class="col"></div>
                            <div class="col d-flex align-items-center justify-content-center">
                                <button class="btn btn-info" onclick='beli(@json($item))'>Beli</button>
                            </div>
                        </div>
                    @endforeach
                </ul>
            </div>
            <div class="col"></div>
        </div>

    </div>
    @include('client.products.single_product')
@endsection


@section('scriptjs')
    <script>
        function beli(product) {
            let discount = product.price - (product.price * product.discount) / 100;
            discount = discount.toLocaleString('id');

            $('#productName').html(product.product_name);
            $('#productPrice').html("Rp. " + product.price.toLocaleString('id'));
            $('#productPriceDiscountValue').html("Rp. " + product.price.toLocaleString('id'));
            $('#productDiscountPrice').html(`Rp. ${discount}`);
            $('#productDimension').html("Dimension: " + product.dimension);
            $('#productUnit').html("Price Unit: " + product.unit);
            $('#allData').val(JSON.stringify(product));

            if(product.discount <= 0) {
                $('#productPrice').prop('hidden', false);
                $('#productPriceDisplayDisc').prop('hidden', true);
                $('#productDiscountPrice').prop('hidden', true);
            }
            else {
                $('#productPrice').prop('hidden', true);
                $('#productPriceDisplayDisc').prop('hidden', false);
                $('#productDiscountPrice').prop('hidden', false);
            }
            $('#quantity').val(1);
            $('#productModal').modal();
        }
    </script>
@endsection
