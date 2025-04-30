<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Account') }}
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
                        <form method="POST" action="store-account" id="accountForm">
                            @csrf
                            <div id="formRepeater">
                                <div class="row g-3 form-group">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="First name" name="first_name[]" aria-label="First name" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Last name" name="last_name[]" aria-label="Last name">
                                    </div>
                                    <div class="col">
                                        <input type="date" class="form-control" placeholder="Date of Birth" name="dob[]" aria-label="Date of Birth" required>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Address" name="address[]" aria-label="Address">
                                    </div>
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-success addMore">+</button>
                                        <button type="button" class="btn btn-danger remove">-</button>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info" style="float:right">Submit</button><br>
                        </form>
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
            // Add new row
            $(document).on('click', '.addMore', function () {
                let $clone = $(this).closest('.form-group').clone();
                $clone.find('input').val('');
                $('#formRepeater').append($clone);
            });
    
            // Remove row
            $(document).on('click', '.remove', function () {
                if ($('#formRepeater .form-group').length > 1) {
                    $(this).closest('.form-group').remove();
                } else {
                    alert("At least one entry is required.");
                }
            });
        });
    </script>
</x-app-layout>
