<?php

namespace App\Livewire\Dashboard;

use Aaran\Aadmin\Src\DbMigration;
use Aaran\Entries\Models\Payment;
use Aaran\Entries\Models\Purchase;
use Aaran\Entries\Models\Receipt;
use Aaran\Entries\Models\Sale;
use App\Helper\ConvertTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class  Index extends Component
{

    public $transaction;

    public function mount()
    {
        if (DbMigration::hasEntry()) {
            $this->transaction = $this->getTransaction();
        }

        if (DbMigration::hasWelfare()) {
            $this->transaction = $this->getWelfareUserTransaction();
        }

    }

    public function getWelfareUserTransaction()
    {
        $no_of_shares = 0;
        $total_investment = 0;
        $total_dividend = 0;
        $total_percent = 0;

        return Collection::make([
            'no_of_shares' => ConvertTo::rupeesFormat($no_of_shares),
            'total_investment' => ConvertTo::rupeesFormat($total_investment),
            'total_dividend' => ConvertTo::rupeesFormat($total_dividend),
            'total_percent' => ConvertTo::rupeesFormat($total_percent),
        ]);
    }


    public function getTransaction()
    {
        $first = date('Y-m-01');
        $last = date('Y-m-t');

        $total_sales = Sale::select(
            DB::raw("SUM(grand_total) as grand_total"),
        )
            ->where('acyear', '=', session()->get('acyear'))
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();


        $month_sales = Sale::select(
            DB::raw("SUM(grand_total) as grand_total"),
        )->where('acyear', '=', session()->get('acyear'))
            ->WhereBetween('invoice_date', [$first, $last])
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();


        $total_purchase = Purchase::select(
            DB::raw("SUM(grand_total) as grand_total"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $month_purchase = Purchase::select(
            DB::raw("SUM(grand_total) as grand_total"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('company_id', '=', session()->get('company_id'))
            ->WhereBetween('purchase_date', [$first, $last])
            ->firstOrFail();


        $total_receivable = Receipt::select(
            DB::raw("SUM(receipt_amount) as receipt_amount"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $month_receivable = Receipt::select(
            DB::raw("SUM(receipt_amount) as receipt_amount"),
        )->where('acyear', '=', session()->get('acyear'))
            ->WhereBetween('vdate', [$first, $last])
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $total_payable = Payment::select(
            DB::raw("SUM(payment_amount) as payment_amount"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('company_id', '=', session()->get('company_id'))
            ->firstOrFail();

        $month_payable = Payment::select(
            DB::raw("SUM(payment_amount) as payment_amount"),
        )->where('acyear', '=', session()->get('acyear'))
            ->where('company_id', '=', session()->get('company_id'))
            ->WhereBetween('vdate', [$first, $last])
            ->firstOrFail();


        return Collection::make([
            'total_sales' => ConvertTo::rupeesFormat($total_sales->grand_total),
            'month_sales' => ConvertTo::rupeesFormat($month_sales->grand_total),
            'total_purchase' => ConvertTo::rupeesFormat($total_purchase->grand_total),
            'month_purchase' => ConvertTo::rupeesFormat($month_purchase->grand_total),
            'total_receivable' => ConvertTo::rupeesFormat($total_receivable->receipt_amount),
            'month_receivable' => ConvertTo::rupeesFormat($month_receivable->receipt_amount),
            'total_payable' => ConvertTo::rupeesFormat($total_payable->payment_amount),
            'month_payable' => ConvertTo::rupeesFormat($month_payable->payment_amount),
        ]);
    }

    public function render()
    {
        return view('livewire.dashboard.index');
    }
}
