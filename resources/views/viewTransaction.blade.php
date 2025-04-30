<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="cr-icon glyphicon glyphicon-ok"></i>&nbsp;<strong>{{ session()->get('success') }}</strong>
                        </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="glyphicon glyphicon-remove"></i>&nbsp;<strong>{{ session()->get('error') }}</strong>
                        </div>
                    @endif
                    @php $user = auth()->user(); @endphp
                    @if($user->id == '1')
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#transferModal">
                            Transfer Amount
                        </button><br><br>
                        <div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="transferModalLabel">Transfer Amount</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="transfer-amount" id="transferForm">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $account->id }}">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Account Number" name="acc_no" max="999999999999" required>
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="currency" required>
                                                    <option value="USD">USD</option>
                                                    <option value="GBP">GBP</option>
                                                    <option value="EUR">EUR</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Enter Amount" name="amount" max="{{ $account->balance }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button class="btn btn-primary">Transfer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="responsive">
                            <table class="table table-striped myTable">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Transaction Type</th>
                                        <th>Amount</th>
                                        <th>Date and Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($data) > 0)
                                        @foreach($data as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                @if($value->type == 'DR')
                                                    <td class="text-danger">Debit</td>
                                                @else
                                                    <td class="text-success">Credit</td>
                                                @endif
                                                <td>{{ $value->amount }}</td>
                                                <td>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{ __("You're logged in!") }}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.myTable').DataTable({
                "pageLength": 10,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
</x-app-layout>
