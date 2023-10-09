@extends('master')

@section('content')
    <div class="container">
        <div class="">
            <div class="row d-flex align-items-center justify-content-center vh-100">
                <div class="col-4 card">
                    <form action="{{ route('login.user') }}" method="post" class="card-body">
                        @csrf()
                        <h5 class="text-center">LOGIN</h5>

                        <br>

                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>

                        <div class="input-group mb-3 mt-4">
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="row d-flex justify-content-center">
                            <div class="col-8 d-flex justify-content-center">
                                <button type="submit" class="btn btn-info btn-block" style="border-radius: 16px !important">LOGIN</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
