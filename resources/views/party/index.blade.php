@extends('layout.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card p-4 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="page-title"><i class="mdi mdi-account-group"></i> Manage Clients</h2>
                    <a href="{{ route('add-party') }}" class="btn btn-primary"><i class="mdi mdi-plus-circle"></i> Add Party</a>
                </div>
                <h4 class="header-title mb-4 text-uppercase"><i class="mdi mdi-table"></i> Client List</h4>
                <div class="table-responsive">
                    <table class="table table-hover table-centered table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No.</th>
                                <th>Client Type</th>
                                <th>Client Info</th>
                                <th>Bank Details</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($parties))
                            @foreach($parties as $index => $party)
                            <tr>
                                <td><b>{{ $index+1 }}</b></td>
                                <td>
                                    <span class="badge badge-info text-capitalize">{{ $party->party_type }}</span>
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0">
                                        <li><b>Name:</b> {{ $party->full_name }}</li>
                                        <li><b>Phone:</b> {{ $party->phone_no }}</li>
                                        <li><b>Address:</b> {{ $party->address }}</li>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="list-unstyled mb-0">
                                        <li><b>Account Holder Name:</b> {{ $party->account_holder_name ?? 'N/A' }}</li>
                                        <li><b>Acc No:</b> {{ $party->account_no ?? 'N/A' }}</li>
                                        <li><b>Bank Name:</b> {{ $party->bank_name ?? 'N/A' }}</li>
                                        <li><b>IFSC Code:</b> {{ $party->ifsc_code ?? 'N/A' }}</li>
                                        <li><b>Branch Address:</b> {{ $party->branch_address ?? 'N/A' }}</li>
                                    </ul>
                                </td>
                                <td>{{ date('d-m-Y', strtotime($party->created_at)) }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('edit-party', $party->id) }}" class="btn btn-sm btn-outline-primary" title="Edit"><i class="mdi mdi-pencil"></i></a>
                                        <form method="post" action="{{ route('delete-party', $party) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete"><i class="mdi mdi-delete"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" class="text-center">No record found!</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection