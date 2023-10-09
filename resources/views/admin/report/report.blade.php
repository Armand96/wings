@extends('admin.master_admin')

@section('content_header')
    <div class="row">
        <div class="col-sm-12">
            <h4>Report Penjualan</h4>
        </div>
        <form class="col-sm-12 mt-3">
            <h4>Filter</h4>

            <div class="row">
                <div class="form-group col">
                    <label for="start_date">Start Date</label>
                    <div class="input-group">
                        <input type="text" name="start_date" id="start_date" class="form-control"
                            value="{{ Request::has('start_date') ? request('start_date') : date('Y-m-d') }}" placeholder="Start Date" readonly>
                    </div>
                </div>
                <div class="form-group col">
                    <label for="end_date">End Date</label>
                    <div class="input-group">
                        <input type="text" name="end_date" id="end_date" class="form-control"
                            value="{{ Request::has('start_date') ? request('start_date') : date('Y-m-d') }}" placeholder="End Date" readonly>
                        <div class="input-group-append">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col d-flex justify-content-end">
                    <button type="button" onclick="print()" class="btn btn-info mr-3">Print</button>
                    <button type="submit" class="btn btn-secondary">Filter</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col">

            <div class="table-responsive">
                <table class="table table-hovered table-striped table-bordered" id="tableReport">
                    <thead class="bg-dark">
                        <tr>
                            <th></th>
                            <th>Transaction</th>
                            <th>User</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Total Item</th>
                            {{-- <th>Item</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($trxHeaders as $index => $trxHead)
                            <tr>
                                <td>{{ $trxHead->document_code.'-'.$trxHead->document_number }}</td>
                                <td>{{ $trxHead->user }}</td>
                                <td>Rp. {{ number_format($trxHead->total, 0, ',', '.') }},-</td>
                                <td>{{ $trxHead->date }}</td>
                                <td>{{ $trxHead->date }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@section('scriptjs')
    <script>
        function print(){
            let startDate = $('#start_date').val();
            let endDate = $('#end_date').val();
            let qryParams = `?start_date=${startDate}&end_date=${endDate}`;
            let urlHost = '{{ route("admin.reports.print") }}' + qryParams;
            window.location.href = urlHost;
        }

        moment.locale('id');

        function format(d) {

            let html = "";
            d.detail.forEach(element => {
                html += `<tr>
                            <td> ${element.product.product_name} </td>
                            <td> ${element.quantity} </td>
                            <td> Rp. ${element.price.toLocaleString('id')} </td>
                            <td> Rp. ${element.subtotal.toLocaleString('id')} </td>
                        </tr>`;
            });

            return (

                `<table class="table table-hovered table-striped table-bordered">
                    <thead class="bg-info">
                        <tr>
                            <th>Product name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    ${html}
                </table>
                `
            );
        }

        const data = @json($trxHeaders);
        let table = new DataTable('#tableReport', {
            data: data,
            columns: [{
                    className: 'dt-control',
                    orderable: false,
                    data: null,
                    defaultContent: ''
                },
                {
                    data: 'document_code',
                    render: function(data, type, row) {
                        return `${data}-${row.document_number}`;
                    }
                },
                {
                    data: 'user'
                },
                {
                    data: 'total',
                    render: function(data, type, row) {
                        return 'Rp. ' + data.toLocaleString('id');
                    }
                },
                {
                    data: 'date',
                    render: function(data, type, row) {

                        return moment().format('DD MMM YYYY');
                    }
                },
                {
                    data: 'detail',
                    render: function(data, type, row) {
                        return row.detail.length;
                    }
                },
            ],
        });

        table.on('click', 'td.dt-control', function(e) {
            let tr = e.target.closest('tr');
            let row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
            } else {
                // Open this row
                row.child(format(row.data())).show();
            }
        });

        $(document).ready(function() {
            let datePickerOptions = {
                changeMonth: true,
                changeYear: true,
                dateFormat: "yy-mm-dd",
            }

            $('#start_date').datepicker(datePickerOptions);
            $('#end_date').datepicker(datePickerOptions);
        });
    </script>
@endsection
