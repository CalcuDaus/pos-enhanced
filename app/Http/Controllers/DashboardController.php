<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'lastYearData' => $this->getYearlySummaryData(),
            'dailyData' => $this->dailySummary(),
            'todaySummary' => $this->todaySummary(),
        ];

        return view('dashboard.index', $data);
    }

    public function report()
    {
        $startOfDay = Carbon::today()->startOfDay();

        // Ambil semua akun beserta mutasi yang terjadi setelah jam 00:00
        $accounts = Account::with(['mutations' => function ($q) use ($startOfDay) {
            $q->where('created_at', '>=', $startOfDay);
        }])->get();

        // Hitung saldo awal, selisih, dan persentase per akun
        $accounts = $accounts->map(function ($account) {
            $currentBalance = $account->balance;

            // Hitung total mutasi hari ini
            $mutationsToday = $account->mutations;
            $totalIn  = $mutationsToday->where('mutation_type', 'in')->sum('amount');
            $totalOut = $mutationsToday->where('mutation_type', 'out')->sum('amount');

            // Saldo awal hari = saldo sekarang - (mutasi masuk hari ini) + (mutasi keluar hari ini)
            $beginBalance = $currentBalance - $totalIn + $totalOut;

            // Hitung persentase perubahan
            $percentage = 0;
            if ($beginBalance > 0) {
                $percentage = (($currentBalance - $beginBalance) / $beginBalance) * 100;
            }

            return [
                'account_id'      => $account->id,
                'account_name'    => $account->account_name,
                'image'    => $account->image,
                'begin_balance'   => $beginBalance,
                'current_balance' => $currentBalance,
                'difference'      => $currentBalance - $beginBalance,
                'percentage'      => round($percentage, 2),
            ];
        });

        // Kirim ke view
        return view('dashboard.report', [
            'accounts' => $accounts,
        ]);
    }
    private function todaySummary()
    {


        $incomeToday = DB::table('incomes')
            ->selectRaw("SUM(amount) as total")
            ->where('date', Carbon::today())
            ->get();


        $expenseToday = DB::table('expenses')
            ->selectRaw("SUM(amount) as total")
            ->where('date', Carbon::today())
            ->get();


        return [
            'incomeToday' => $incomeToday,
            'expenseToday' => $expenseToday,
        ];
    }

    private function getYearlySummaryData()
    {
        $incomePerMonth = DB::table('incomes')
            ->selectRaw("MONTH(date) as month, SUM(amount) as total")
            ->whereYear('date', now()->year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->pluck('total', 'month');

        // Pengeluaran per bulan
        $expensePerMonth = DB::table('expenses')
            ->selectRaw("MONTH(date) as month, SUM(amount) as total")
            ->whereYear('date', now()->year)
            ->groupBy(DB::raw('MONTH(date)'))
            ->pluck('total', 'month');

        // Gabungkan data ke array sesuai bulan
        $incomeData = [];
        $expenseData = [];
        $categories = [];
        $incomeDataTotal = 0;
        $expenseDataTotal = 0;

        foreach (range(1, 12) as $m) {
            $monthName = Carbon::create()->month($m)->format('M');
            $categories[] = $monthName;
            $incomeData[] = round($incomePerMonth[$m] ?? 0);
            $expenseData[] = round($expensePerMonth[$m] ?? 0);
            $incomeDataTotal += $incomeData[count($incomeData) - 1];
            $expenseDataTotal += $expenseData[count($expenseData) - 1];
        }

        return [
            'categories' => $categories,
            'incomeData' => $incomeData,
            'expenseData' => $expenseData,
            'incomeDataTotal' => $incomeDataTotal,
            'expenseDataTotal' => $expenseDataTotal,
        ];
    }

    private function dailySummary()
    {
        $start = Carbon::now()->subDays(6)->startOfDay(); // 6 hari ke belakang + hari ini = 7 hari
        $end = Carbon::now()->endOfDay();

        // Pendapatan harian
        // $incomePerDay = DB::table('sale_items')
        //     ->selectRaw("DATE(created_at) as date, SUM(profit) as total")
        //     ->whereBetween('created_at', [$start, $end])
        //     ->groupBy(DB::raw("DATE(created_at)"))
        //     ->pluck('total', 'date');

        $incomePerDay = DB::table('incomes')
            ->selectRaw("DATE(date) as date, SUM(amount) as total")
            ->whereBetween('date', [$start, $end])
            ->groupBy(DB::raw("DATE(date)"))
            ->pluck('total', 'date');

        // Pengeluaran harian
        $expensePerDay = DB::table('expenses')
            ->selectRaw("DATE(date) as date, SUM(amount) as total")
            ->whereBetween('date', [$start, $end])
            ->groupBy(DB::raw("DATE(date)"))
            ->pluck('total', 'date');

        // Siapkan data
        $categories = [];
        $incomeData = [];
        $expenseData = [];
        $incomeDataTotal = 0;
        $expenseDataTotal = 0;

        foreach (range(0, 6) as $i) {
            $date = Carbon::now()->subDays(6 - $i)->format('Y-m-d');
            $label = Carbon::parse($date)->locale('id')->isoFormat('dddd');

            $categories[] = $label;
            $incomeData[] = round($incomePerDay[$date] ?? 0);
            $expenseData[] = round($expensePerDay[$date] ?? 0);
            $incomeDataTotal += $incomeData[count($incomeData) - 1];
            $expenseDataTotal += $expenseData[count($expenseData) - 1];
        }

        return  [
            'categories' => $categories,
            'incomeData' => $incomeData,
            'expenseData' => $expenseData,
            'incomeDataTotal' => $incomeDataTotal,
            'expenseDataTotal' => $expenseDataTotal,
        ];
    }
}
