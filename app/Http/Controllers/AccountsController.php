<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Transaction;

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

    public function viewAccount($id)
    {
        $account = Account::findOrFail($id);
        $data = Transaction::where('acc_no', $account->acc_no)->get();
        return view('viewTransaction')->with('data', $data)->with('account', $account);
    }

    public function transferAmount(Request $request)
    {
        $from_account = Account::findOrFail($request->input('id'));
        $to_account = Account::where('acc_no', $request->input('acc_no'))->first();

        if($from_account->acc_no == $to_account->acc_no) {
            return redirect()->back()->with('error', 'You cannot trasfer to same account');
        }

        if($to_account) {

            $fromAccountBalance = $from_account->balance - $request->amount;
            $toAccountBalance = $to_account->balance + $request->amount;

            $from_account->update(['balance' => $fromAccountBalance]);
            $to_account->update(['balance' => $toAccountBalance]);

            Transaction::create([
                'acc_no' => $from_account->acc_no,
                'type' => 'DR',
                'amount' => $request->amount
            ]);

            Transaction::create([
                'acc_no' => $to_account->acc_no,
                'type' => 'CR',
                'amount' => $request->amount
            ]);

            return redirect()->back()->with('success', 'Amount transferred successfully!');
        } else {
            return redirect()->back()->with('error', 'Invalid account number');
        }
    }
}
