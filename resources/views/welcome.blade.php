@extends('layouts.app')
@section('content')
    <div class="container mt-10">

        <div class="w-lg-75 text-center mx-md-auto mb-md-5">
            <h2 class="h1 lh-sm">Developer Challenge - Invoicing</h2>
        </div>

        <div class="row align-items-md-center content-space-2 content-space-b-lg-2">
            <div class="col-md-6 order-md-2 mb-10 mb-md-0 text-center offset-3" >
                   <p>build a UI and API that allow a user to capture invoices as shown in the image below, and store it in a database</p>
                   <img class="device-browser-img" src="assets/img/excel-invoice-template.png">
                <div class="mt-10">
                <a class="btn btn-primary btn-transition" href="{{route("add.invoice")}}">View solution<i class="bi-chevron-right small "></i></a>
                </div>


            </div>
        </div>
    </div>


@endsection
