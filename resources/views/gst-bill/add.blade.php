@extends('layout.app')

@section('content')
<style>
    .custom-form-section {
        background: #f8f9fa;
        border-radius: 16px;
        box-shadow: 0 4px 24px rgba(44, 62, 80, 0.08);
        padding: 2.5rem 2rem 2rem 2rem;
        margin-top: 2rem;
        margin-bottom: 2rem;
    }
    .custom-form-section h4, .custom-form-section h2 {
        color: #4f5d73;
        font-weight: 700;
        margin-bottom: 1.2rem;
    }
    .custom-form-section label {
        font-weight: 500;
        color: #495057;
    }
    .custom-form-section .form-control, .custom-form-section textarea {
        border-radius: 8px;
        border: 1px solid #e3e6ea;
        background: #fff;
        box-shadow: none;
        margin-bottom: 1rem;
    }
    .custom-form-section .btn-primary {
        background: linear-gradient(90deg, #6a82fb 0%, #fc5c7d 100%);
        border: none;
        font-weight: 600;
        padding: 0.6rem 2.2rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(108, 99, 255, 0.08);
    }
    .custom-form-section .btn-secondary {
        background: #e3e6ea;
        color: #4f5d73;
        border: none;
        font-weight: 500;
        padding: 0.6rem 2.2rem;
        border-radius: 8px;
        margin-left: 0.5rem;
    }
    .custom-form-section .input-group-text {
        background: #f1f3f6;
        border: none;
        border-radius: 8px 0 0 8px;
        color: #6a82fb;
    }
    .custom-form-section .section-icon {
        font-size: 1.5rem;
        color: #6a82fb;
        margin-right: 0.5rem;
    }
    .custom-form-section .border {
        border-radius: 8px !important;
        border: 1px solid #e3e6ea !important;
        background: #fff;
    }
    .custom-form-section .gststyle {
        color: #6a82fb;
        font-weight: 600;
    }
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="custom-form-section">
                <h2 class="text-center mb-4" style="color:#6a82fb;font-weight:800;letter-spacing:1px;"><i class="mdi mdi-file-document-box-multiple section-icon"></i> Create GST Bill</h2>
                <form action="{{ route('create-gst-bill') }}" method="post">
                    @csrf
                    <h4><i class="mdi mdi-information-outline section-icon"></i> Invoice Basic Info</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Party</label>
                                <select class="form-control" name="party_id" required>
                                    <option value="">Please select</option>
                                    @foreach($parties ?? [] as $party)
                                    <option value="{{ $party->id }}">{{ $party->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Invoice Date</label>
                                <input type="date" name="invoice_date" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Invoice Number</label>
                                <input type="text" name="invoice_no" class="form-control" placeholder="Enter Invoice number" required>
                            </div>
                        </div>
                    </div>
                    <h4 class="mt-4"><i class="mdi mdi-format-list-bulleted section-icon"></i> Item Details</h4>
                    <div class="row">
                        <div class="col-md-8 border p-2 text-center">
                            <b>DESCRIPTIONS</b>
                        </div>
                        <div class="col-md-4 border p-2 text-center">
                            <b>TOTAL AMOUNT</b>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-8 border p-2">
                            <input class="form-control" name="item_description" placeholder="Item description" required />
                        </div>
                        <div class="col-md-4 border p-2">
                            <input class="form-control" type="text" name="total_amount" id="totalAmountInput" oninput="calculateNetAmount()" placeholder="Total amount" required>
                        </div>
                    </div>
                    <div class="row mt-0">
                        <div class="col-md-3">
                            <label>CGST (%)</label>
                            <input type="text" class="form-control" placeholder="CGST Rate" name="cgst_rate" id="cgst" oninput="calculateNetAmount()">
                            <span class="float-right gststyle" id="cgstDisplay">0</span>
                            <input type="hidden" id="cgstAmount" name="cgst_amount" value="0">
                        </div>
                        <div class="col-md-3">
                            <label>SGST (%)</label>
                            <input type="text" class="form-control" placeholder="SGST Rate" name="sgst_rate" id="sgst" oninput="calculateNetAmount()">
                            <span class="float-right gststyle" id="sgstDisplay">0</span>
                            <input type="hidden" id="sgstAmount" name="sgst_amount" value="0">
                        </div>
                        <div class="col-md-3">
                            <label>IGST (%)</label>
                            <input type="text" class="form-control" placeholder="IGST Rate" name="igst_rate" id="igst" oninput="calculateNetAmount()">
                            <span class="float-right gststyle" id="igstDisplay">0</span>
                            <input type="hidden" id="igstAmount" name="igst_amount" value="0">
                        </div>
                        <div class="col-md-3">
                            <ul style="list-style: none;float: right;">
                                <li>
                                    <b>Total Amount:</b> ₹ <span type="text" id="totalAmountDisplay">0</span>
                                </li>
                                <li>
                                    <b>Tax:</b> ₹ <span type="text" id="taxDisplay">0</span>
                                    <input type="hidden" value="0" name="tax_amount" id="taxAmount">
                                </li>
                                <li>
                                    <b>Net Amount:</b> ₹ <span type="text" id="netAmountDisplay">0</span>
                                    <input type="hidden" value="0" name="net_amount" id="netAmount">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="declaration" class="form-control" placeholder="Declaration">
                            </div>
                            <div class="text-center mt-4">
                                <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save"></i> SUBMIT</button>
                                <button class="btn btn-secondary" type="reset"><i class="mdi mdi-refresh"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection