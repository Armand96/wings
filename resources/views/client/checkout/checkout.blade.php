@extends('client.master_client')

@section('content')
    <div class="container">

        <div class="row mt-5">
            <div class="col"></div>
            <div class="col-6">
                <ul class="card p-3 pr-0">
                    @php
                        $total = 0;
                    @endphp

                    @foreach ($products as $index => $cart)
                        @php
                            $total += $cart->subtotal;
                        @endphp

                        <div class="row my-2">
                            <div class="col-4 d-flex justify-content-center">
                                <img src="{{ asset('/img/wings.png') }}" alt="gambar" class="img-thumbnail" width="120px">
                            </div>
                            <div class="col-4">
                                <p class="p-0 m-0">{{ $cart->product->product_name }}</p>
                                <small class="p-0 m-0">Rp. {{ number_format($cart->price, 0, ',', '.') }},- / {{ $cart->product->unit }}</small>
                                <b class="p-0 m-0" id="subtotal_{{$index}}">Subtotal: Rp. {{ number_format($cart->subtotal, 0, ',', '.') }},- </b>
                                <input type="hidden" id="subtotalInput_{{$index}}" value="{{$cart->subtotal}}">
                            </div>
                            <div class="col-1"></div>
                            <div class="col d-flex align-items-center justify-content-center">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" onclick="substract({{$index}}, '{{$cart->product_code}}', {{$cart->price}})" class="input-group-text" style="border-radius: 16px !important">-</button>
                                    </div>
                                    <input type="number" class="form-control" id="quantity_{{$index}}" onchange="updateQty({{$index}}, '{{ $cart->product_code }}')" value="{{ $cart->quantity }}" min="1"
                                        required>
                                    <div class="input-group-append">
                                        <button type="button" onclick="add({{$index}}, '{{$cart->product_code}}', {{$cart->price}})" class="input-group-text" style="border-radius: 16px !important">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="d-flex justify-content-center mt-2">
                        <b class="border border-dark p-2">Total: Rp. <span id="total">{{ number_format($total, 0, ',', '.') }},-</span> </b>
                        <input type="hidden" id="totalInput" value="{{$total}}">
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <a href="{{route('user.checkout')}}" type="button" class="btn btn-info">CONFIRM</a>
                    </div>
                </ul>
            </div>
            <div class="col"></div>
        </div>

    </div>

    <script>
        const textSub = "Subtotal: Rp. ";

        function add(index, productCode, price) {
            /* GET */
            let qty = $('#quantity_'+index).val();
            let subtotal = $('#subtotalInput_'+index).val();
            let total = $('#totalInput').val();

            /* MANIPULATE */
            qty = parseInt(qty) + 1;
            let priceNow = qty * price;
            total = total - subtotal + priceNow;

            /* UPDATE */
            $('#quantity_'+index).val(qty);
            $('#subtotalInput_'+index).val(priceNow);
            $('#subtotal_'+index).html(textSub + priceNow.toLocaleString('id'));
            $('#total').html(total.toLocaleString('id'));
            $('#totalInput').val(total);
            updateQty(index, productCode);
        }

        function substract(index, productCode, price) {
            /* GET */
            let qty = $('#quantity_'+index).val();
            let subtotal = $('#subtotalInput_'+index).val();
            let total = $('#totalInput').val();

            /* MANIPULATE */
            qty = parseInt(qty) - 1;
            if (qty <= 0) qty = 1;
            let priceNow = qty * price;
            total = total - subtotal + priceNow;
            console.log(total);

            /* UPDATE */
            $('#quantity_'+index).val(qty);
            $('#subtotalInput_'+index).val(priceNow);
            $('#subtotal_'+index).html(textSub + priceNow.toLocaleString('id'));
            $('#total').html(total.toLocaleString('id'));
            $('#totalInput').val(total);
            updateQty(index, productCode);
        }

        function updateQty(index, productCode) {
            let qty = $('#quantity_'+index).val();
            if(qty > 0) {
                let sendData = {
                    product_code: productCode,
                    quantity: qty,
                };

                axios.post('{{ route("user.chgqty") }}', sendData).then(response => {
                    console.log(response);
                });

                // console.log(sendData);
            }
        }
    </script>
@endsection
