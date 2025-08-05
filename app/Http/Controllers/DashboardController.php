<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    private function todaySummary()
    {


        $incomeToday = DB::table('sale_items')
            ->selectRaw("SUM(profit) as total")
            ->where('created_at', Carbon::today())
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
        // Pendapatan per bulan
        $incomePerMonth = DB::table('sale_items')
            ->selectRaw("MONTH(created_at) as month, SUM(profit) as total")
            ->whereYear('created_at', now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
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
        $incomePerDay = DB::table('sale_items')
            ->selectRaw("DATE(created_at) as date, SUM(profit) as total")
            ->whereBetween('created_at', [$start, $end])
            ->groupBy(DB::raw("DATE(created_at)"))
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
