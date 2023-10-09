<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Report</title>
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
</head>

<body>

    <div class="container-fluid">

        <div class="px-2 mt-5 mx-5">
            <b>Start Date: {{ date('Y M d', strtotime(request('start_date'))) }}</b>

            <br>

            <b>End Date: {{ date('Y M d', strtotime(request('end_date'))) }}</b>
        </div>
        <div class="row mx-5">
            <div class="col d-flex justify-content-center">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Transaction</th>
                                <th>User</th>
                                <th>Total</th>
                                <th>Date</th>
                                <th>Item</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trxHeaders as $index => $trxHead)
                                <tr>
                                    <td>{{ $trxHead->document_code . '-' . $trxHead->document_number }}</td>
                                    <td>{{ $trxHead->user }}</td>
                                    <td>Rp. {{ number_format($trxHead->total, 0, ',', '.') }},-</td>
                                    <td>{{ date('d M Y', strtotime($trxHead->date)) }}</td>
                                    <td>
                                        @foreach ($trxHead->detail as $dtl)
                                            {{ $dtl->product->product_name }} x {{ $dtl->quantity }} <br>
                                        @endforeach
                                    </td>
                                </tr>

                                {{-- <tr>
                                    <td colspan="5" class="text-center">Detail</td>
                                </tr>

                                <tr>
                                    <th colspan="2">Product name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                                @foreach ($trxHead->detail as $dtl)
                                    <tr>
                                        <td colspan="2">{{ $dtl->product->product_name }}</td>
                                        <td>{{ $dtl->quantity }}</td>
                                        <td>{{ $dtl->price }}</td>
                                        <td>{{ $dtl->subtotal }}</td>
                                    </tr>
                                @endforeach --}}
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
