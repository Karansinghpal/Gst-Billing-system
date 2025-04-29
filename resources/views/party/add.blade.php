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
    .custom-form-section h4 {
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
</style>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="custom-form-section">
                <h2 class="text-center mb-4" style="color:#6a82fb;font-weight:800;letter-spacing:1px;">Add New Party</h2>
                <form class="needs-validation" method="post" action="{{ route('create-party') }}">
                    @csrf
                    <h4><i class="mdi mdi-account-multiple"></i> Basic Info</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Type</label>
                                <select name="party_type" class="form-control" required>
                                    <option value="">Please select</option>
                                    <option value="client" @if(old('party_type')=='client' ) selected @endif>Client</option>
                                    <option value="vendor" @if(old('party_type')=='vendor' ) selected @endif>Vendor</option>
                                    <option value="employee" @if(old('party_type')=='employee' ) selected @endif>Employee</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Full Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="mdi mdi-account"></i></span>
                                    </div>
                                    <input type="text" value="{{ old('full_name') }}" name="full_name" class="form-control" placeholder="Enter full name" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Phone/Mobile Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="mdi mdi-phone"></i></span>
                                    </div>
                                    <input type="text" name="phone_no" value="{{ old('phone_no') }}" class="form-control" placeholder="Enter phone/mobile number" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="mdi mdi-map-marker"></i></span>
                                    </div>
                                    <input type="text" name="address" class="form-control" placeholder="Enter address" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h4 class="mt-4"><i class="mdi mdi-bank"></i> Bank Details</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Holder Name</label>
                                <input type="text" class="form-control" name="account_holder_name" placeholder="Account holder name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Account Number</label>
                                <input type="text" class="form-control" name="account_no" placeholder="Account number" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bank Name</label>
                                <input type="text" class="form-control" name="bank_name" placeholder="Bank name" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>IFSC Code</label>
                                <input type="text" class="form-control" name="ifsc_code" placeholder="IFSC code" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Branch Address</label>
                                <input type="text" class="form-control" name="branch_address" placeholder="Branch address" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-content-save"></i> Submit</button>
                        <button class="btn btn-secondary" type="reset"><i class="mdi mdi-refresh"></i> Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection