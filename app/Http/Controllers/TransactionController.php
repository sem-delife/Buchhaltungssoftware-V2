<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        return view('transactions.index', compact('transactions'));
    }

    public function create(Request $request)
    {
        $id = $request->input('user_id');
        $name = $request->input('name');
        $amount = str_replace(',', '.', $request->input('amount'));
        $date = str_replace('-', '.', $request->input('date'));

        function formatDate($date)
        {
            $parts = explode('.', $date);
            $formattedDate = $parts[2] . '.' . $parts[1] . '.' . $parts[0];
            return $formattedDate;
        }

        $date = formatDate($date);

        function isDate($input)
        {
            $date = \DateTime::createFromFormat("d.m.Y", $input);
            return $date && $date->format("d.m.Y") === $input;
        }

        function isValidMoneyAmount($input)
        {
            $pattern = '/^-?\d+(\.\d{1,2})?$/';
            return preg_match($pattern, $input) || is_int($input);
        }

        if (isDate($date) && isValidMoneyAmount($amount)) {
            $oldBalance = (float) DB::connection('mysql')
                ->table('users')
                ->select('amount')
                ->where('id', $id)
                ->get()[0]->amount;

            $newBalance = $oldBalance + (float) $amount;

            $insertTransaction = DB::connection('mysql')
                ->table('transactions')
                ->insert([
                    'name' => $name,
                    'created_at' => $date,
                    'amount' => $amount,
                    'user_id' => $id,
                ]);

            $changeUserBalance = DB::connection('mysql')
                ->table('users')
                ->where('id', $id)
                ->update(['amount' => $newBalance]);

            return redirect()->route('transaction');
        } else {
            return view('login', [
                'error' => 'Ungültiges Datum, ungültiger Geldbetrag oder ungültige Länge!',
            ]);
        }
    }
}
