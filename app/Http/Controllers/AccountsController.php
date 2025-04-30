<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountsController extends Controller
{
    public function storeAccount(Request $request)
    {
        $firstNames = $request->input('first_name');
        $lastNames = $request->input('last_name');
        $dobs = $request->input('dob');
        $addresses = $request->input('address');

        foreach ($firstNames as $index => $firstName) {
            Account::create([
                'acc_no' => random_int(100000000000, 999999999999),
                'first_name' => $firstName,
                'last_name' => $lastNames[$index],
                'dob' => $dobs[$index],
                'address' => $addresses[$index],
            ]);
        }

        return redirect()->back()->with('success', 'Accounts saved successfully!');
    }
}
