<div class="modal fade" id="productModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title text-center">PRODUCT DETAIL</h5>
            </div>
            <form action="" method="POST" id="formCart" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">

                    <div class="row">
                        <div class="col-5 d-flex justify-content-center">
                            <img src="{{ asset('/img/wings.png') }}" alt="gambar" class="img-thumbnail"
                                width="140px">
                        </div>

                        <div class="col">
                            <p class="p-0 m-0" id="productName"></p>
                            <p class="p-0 m-0" id="productPrice"></p>
                            <small id="productPriceDisplayDisc">
                                <del class="p-0 m-0" id="productPriceDiscountValue"></del>
                            </small>
                            <p class="p-0 m-0" id="productDiscountPrice"></p>
                            <p class="m-0 p-0" id="productDimension">Dimension:</p>
                            <p class="m-0 p-0" id="productUnit">Price Unit:</p>
                        </div>
                    </div>

                    <input type="hidden" id="allData" value="">
                </div>

                <div class="modal-footer justify-content-between">
                    <div class="mt-3">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <button type="button" onclick="substract()" class="input-group-text">-</button>
                            </div>
                            <input type="number" id="quantity" class="form-control" value="1" min="1"
                                required>
                            <div class="input-group-append">
                                <button type="button" onclick="add()" class="input-group-text">+</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" onclick="addToCart()" class="btn bg-navy">Beli</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function add() {
        let currentData = $('#quantity').val();
        currentData = parseInt(currentData) + 1;
        $('#quantity').val(currentData);
    }

    function substract() {
        let currentData = $('#quantity').val();
        currentData = parseInt(currentData) - 1;
        if(currentData <= 0) currentData = 1;
        $('#quantity').val(currentData);
    }

    async function addToCart() {
        let data = $('#allData').val();
        data = JSON.parse(data);
        let qty = $('#quantity').val();

        let sendData = {
            product_code: data.product_code,
            quantity: qty,
        };

        await axios.post('{{ route("user.addtocart") }}', sendData).then(response => {
            toastrShow("Success", "Added to cart", "success");
        }).catch(err => {
            console.log(err);
            toastrShow("Failed", "Failed add to cart", "danger");
        });

        await axios.get('{{ route("count.cart") }}').then( response => {
            console.log('data count', response);
            $('#cartCount').html(response.data.dataCount);
        }).catch(err => {
            console.log(err);
            toastrShow("Failed", "Failed add to cart", "danger");
        });

        $('#productModal').modal('hide');
        console.log(data);
    }
</script>
