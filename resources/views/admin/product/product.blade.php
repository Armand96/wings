@extends('admin.master_admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-12">
            <h4>Products</h4>
            <button class="btn btn-dark float-right" onclick="addProduct()">Add Product</button>
        </div>
    </div>
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col">

            <div class="table-responsive">
                <table class="table table-hovered table-striped table-bordered" id="tableProducts">
                    <thead class="bg-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th>Product Code</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Currency</th>
                            <th>Discount</th>
                            <th>Dimension</th>
                            <th>Unit</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $prod)
                            <tr>
                                <td class="text-center">{{ $index += 1 }}</td>
                                <td>{{ $prod->product_code }}</td>
                                <td>{{ $prod->product_name }}</td>
                                <td class="text-right">{{ number_format($prod->price, 0, ',', '.') }},-</td>
                                <td>{{ $prod->currency }}</td>
                                <td class="text-right">{{ number_format($prod->discount, 0, ',', '.') }}%</td>
                                <td>{{ $prod->dimension }}</td>
                                <td>{{ $prod->unit }}</td>
                                <td class="text-center">
                                    <button class="btn btn-info" onclick='editProduct(@json($prod))' style="border-radius: 16px !important" style="border-radius: 16px !important">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    @include('admin.product.add_product')
@endsection


@section('scriptjs')
    <script>
        $(document).ready(function() {
            $('#tableProducts').dataTable();
        });

        function addProduct() {
            $('#formProduct').trigger('reset');
            $('#formProduct').prop('action', '{{ route("admin.product.store") }}');
            $('input[name="_method"]').val('POST');
            $('#productModal').modal();
        }

        function editProduct(product) {

            $('#product_code').val(product.product_code);
            $('#product_code').prop('readonly', true);
            $('#product_name').val(product.product_name);
            $('#price').val(product.price);
            $('#currency').val(product.currency);
            $('#discount').val(product.discount);
            $('#dimension').val(product.dimension);
            $('#unit').val(product.unit);

            $('#formProduct').prop('action', '{{ url("admin/products") }}/' + product.product_code);
            $('input[name="_method"]').val('PATCH');
            $('#productModal').modal();
        }
    </script>
@endsection
