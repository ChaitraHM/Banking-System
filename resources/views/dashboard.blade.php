<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @php $user = auth()->user(); @endphp
                    @if($user->id == '1')
                        <a href="create-account">
                            <button class="btn btn-danger">Create New Account</button>
                        </a><br><br>

                        <div class="responsive">
                            <table class="table table-striped myTable">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Account Number</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Date of Birth</th>
                                        <th>Address</th>
                                        <th>Balance</th>
                                        <th>Status</th>
                                        <th>Transactions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($result) > 0)
                                        @foreach($result as $key => $value)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $value->acc_no }}</td>
                                                <td>{{ $value->first_name }}</td>
                                                <td>{{ $value->last_name }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->dob)) }}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>{{ $value->balance }}</td>
                                                @if($value->status == 1)
                                                    <td class="text-success">Active</td>
                                                @else
                                                    <td class="text-danger">Inactive</td>
                                                @endif
                                                <td>
                                                    <a href="{!! route('view.account', $value->id) !!}" class="btn btn-sm btn-info" title="View">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
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
