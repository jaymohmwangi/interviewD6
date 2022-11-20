@extends('layouts.app')
@section('content')
    <main id="content" role="main">
        <!-- Content -->
        <div class="container content-space-2">
            <div class="w-lg-85 mx-lg-auto">
                <!-- Card -->
                <div class="card card-lg mb-5">
                    <form id="add-invoice-form" action="{{route("store.invoice")}}" method="post">
                        @csrf
                    <div class="card-body">
                        <div class="row justify-content-lg-between">
                            <div class="col-sm-5 order-2 order-sm-1 mb-3">
                                <h1 class="h2 text-primary">D6 Group.</h1>
                                <address class="text-dark">
                                    Monument Park, Pretoria<br>
                                    Zip code: 0001<br>
                                    Phone: +27 87 820 0088<br>
                                    Website: https://d6.co.za/<br>
                                </address>
                            </div>
                            <!-- End Col -->

                            <div class="col-sm-7 order-1 order-sm-2 text-sm-end mb-3">
                                <div class="mb-3">
                                    <h2>Invoice</h2>
                                </div>
                                <dl class="row">
                                    <dt class="col-sm-4">Customer:</dt>
                                    <dd class="col-sm-8">
                                        <select class="form-select" name="customer_id" id="customer_id" onchange="formActions.showBillTo()" required>
                                            <option value="" selected disabled>Select customer</option>
                                            @if(!empty($customers))
                                                @foreach($customers as $customer)
                                                    <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-4">Invoice date:</dt>
                                    <dd class="col-sm-8"><input type="text" class="form-control" data-datedropper data-dd-format="Y-m-d" required
                                                                name="invoice_date" placeholder="Invoice date"></dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-4">Due date:</dt>
                                    <dd class="col-sm-8"><input type="text" class="form-control" data-datedropper data-dd-format="Y-m-d"
                                                                name="due_date"  placeholder="Due date" required>
                                    </dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-4">Currency:</dt>
                                    <dd class="col-sm-8">
                                        <select class="form-select" name="currency" required>
                                            <option value="" selected disabled>Select Currency</option>
                                            <option value="USD">USD</option>
                                            <option value="ZAR">ZAR</option>
                                            <option value="KES">KES</option>
                                        </select>
                                    </dd>
                                </dl>
                            </div>
                            <!-- End Col -->
                        </div>
                        <!-- End Row -->
                        <div class="row justify-content-lg-between" id="bill-to">
                            <div class="col-sm-5 order-2 order-sm-1 mb-3">
                                <h1 class="h2 text-primary">Bill To :</h1>
                                <address class="text-dark" id="bill-to-data">
                                    <span id="bill-to-data-name"> Name: John Doe</span><br>
                                    <span id="bill-to-data-biz-name"> Company Name: John Doe</span><br>
                                    <span id="bill-to-data-biz-name"> Email: john@gmail.com</span><br>
                                    <span id="bill-to-data-biz-name"> Phone: 245 4543 3422</span><br>
                                    <span> Street: city, street ,zip code</span>
                                </address>
                            </div>
                        </div>
                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-borderless table-nowrap table-align-middle" id="invoiceItem">
                                <thead class="thead-light">
                                <tr>
                                    <th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
                                    <th>Description</th>
                                    <th>Taxed</th>
                                    <th>Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <td><input class="itemRow" type="checkbox"></td>
                                <td><input type="text" name="description[]" id="description_1" class="form-control" required></td>
                                <td class="justify-content-sm-center"><input type="checkbox" name="taxed[]" id="taxed_1"
                                                                             onchange="calculateTaxableTotal()"
                                                                             class="formcontrol"></td>
                                <td><input type="number" name="amount[]" id="amount_1" class="form-control total"
                                           required></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table -->

                        <hr class="my-5">

                        <div class="row  mb-3">
                            <div class="col-md-4 col-lg-5">
                                <button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
                                <button class="btn btn-success" id="addRows" type="button">+ Add More</button>
                                <div class="mt-10">
                                    <h3>Notes: </h3>
                                    <div class="form-group">
                                        <textarea class="form-control txt" rows="5" name="notes" id="notes"
                                                  placeholder="Your Notes"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-7">
                                <dl class="row text-sm-end">
                                    <dt class="col-sm-6">Subtotal:</dt>
                                    <dd class="col-sm-6"><input type="text" class="form-control" name="sub_total" required
                                                                id="subTotal" placeholder="Subtotal"></dd>
                                    <dt class="col-sm-6">Taxable:</dt>
                                    <dd class="col-sm-6"><input type="text" class="form-control" name="taxable_total"
                                                                id="taxableAmount" placeholder="Taxable"></dd>
                                    <dt class="col-sm-6">Tax Rate:</dt>
                                    <dd class="col-sm-6"><input type="text" class="form-control" name="tax_rate"
                                                                id="taxRate" placeholder="Tax Rate"></dd>
                                    <dt class="col-sm-6">Tax Amount:</dt>
                                    <dd class="col-sm-6"><input type="text" class="form-control" name="tax_amount"
                                                                id="taxAmount" placeholder="Tax Amount"></dd>
                                    <dt class="col-sm-6">Total:</dt>
                                    <dd class="col-sm-6"><input type="text" class="form-control" name="total_after_tax" required
                                                                id="totalAftertax" placeholder="Total"></dd>
                                    <dt class="col-sm-6">Amount paid:</dt>
                                    <dd class="col-sm-6"><input type="text" class="form-control" name="amount_paid"
                                                                id="amountPaid" placeholder="Amount Paid"></dd>
                                    <dt class="col-sm-6">Due balance:</dt>
                                    <dd class="col-sm-6"><input type="text" class="form-control" name="amount_due" required
                                                                id="amountDue" placeholder="Amount Due"></dd>
                                </dl>
                                <!-- End Row -->
                            </div>
                        </div>
                        <!-- End Row -->
                        <hr>
                        <div class="d-flex justify-content-end d-print-none gap-3">
                            <button class="btn btn-primary" >
                                <i class="bi-save me-1"></i> Save
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
                <!-- End Card -->

            </div>
        </div>
        <!-- End Content -->
    </main>
    <script src="{{url("assets/js/datedropper-jquery.js")}}"></script>
    <script src="{{url("assets/js/actions.js")}}"></script>
    <script src="{{url("assets/js/invoice.js")}}"></script>
    <script>
        $("#bill-to").slideUp();
        $(document).on('submit', '#add-invoice-form', function (e) {
            e.preventDefault();
            let form= $("#add-invoice-form");
            let button= $('.btn-add-invoice');
            let data=new FormData(this);
            formActions.saveInvoice(data,form,button);
        });
    </script>

@endsection
