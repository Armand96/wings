<div class="modal fade" id="productModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title text-center">Add Product</h5>
            </div>
            <form action="" method="POST" id="formProduct" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="modal-body">

                    <div class="mx-3">
                        <div class="form-group row">
                            <label for="product_code">Product Code</label>
                            <input type="text" name="product_code" id="product_code" class="form-control"  required>
                        </div>

                        <div class="form-group row">
                            <label for="product_name">Product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" required>
                        </div>

                        <div class="form-group row">
                            <label for="price">Price</label>
                            <input type="text" name="price" id="price" class="form-control" required>
                        </div>

                        <div class="form-group row">
                            <label for="currency">Currency</label>
                            <input type="text" name="currency" id="currency" class="form-control" value="IDR" readonly required>
                        </div>

                        <div class="form-group row">
                            <label for="discount">Discount</label>
                            <input type="number" min="0" name="discount" id="discount" value="0" class="form-control" required>
                        </div>

                        <div class="form-group row">
                            <label for="dimension">Dimension</label>
                            <input type="text" name="dimension" id="dimension" class="form-control" required>
                        </div>

                        <div class="form-group row">
                            <label for="unit">Unit</label>
                            <input type="text" name="unit" id="unit" class="form-control" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-default" data-dismiss="modal" style="border-radius: 16px !important">Close</button>
                    <button type="submit" class="btn bg-navy" style="border-radius: 16px !important">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
