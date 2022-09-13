<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $month = 12;

        $successTransactions = Transaction::getData($month, 1);
        $successTransactionsChart = $this->chart($successTransactions, $month);

        $unsuccessTransactions = Transaction::getData($month, 0);
        $unsuccessTransactionsChart = $this->chart($unsuccessTransactions, $month);

        return view('admin.dashboard', [
            'successTransactions' => array_values($successTransactionsChart),
            'unsuccessTransactions' => array_values($unsuccessTransactionsChart),
            'labels' => array_keys($successTransactionsChart),
            'transactionsCount' => [$successTransactions->count() , $unsuccessTransactions->count()]
        ]);
    }

    public function chart($transactions, $month)
    {
        $monthName = $transactions->map(function ($item) {
            return verta($item->created_at)->format('%B %y');
        });

        $amount = $transactions->map(function ($item) {
            return $item->amount;
        });

        foreach ($monthName as $i => $v) {
            if (!isset($result[$v])) {
                $result[$v] = 0;
            }
            $result[$v] += $amount[$i];
        }

        if (count($result) != $month) {
            for ($i = 0; $i < $month; $i++) {
                $monthName = verta()->subMonth($i)->format('%B %y');
                $shamsiMonths[$monthName] = 0;
            }
            return array_reverse(array_merge($shamsiMonths, $result));
        }
        return $result;
    }
}
