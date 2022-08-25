<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use App\Exports\SalesFilterExport;
use App\Models\Order;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application
     * |\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function salesSummary(Request $request)
    {

        $data = Sale::query();
        if(isset($request->start_date) || isset($request->end_date)){
            $from = $request->start_date ?? Carbon::today()->subDays(30);
            $to = $request->end_date ?? Carbon::today();
            $data->whereBetween(DB::raw('DATE(created_at)'), array($from, $to));
        } else {
            $data->whereDate('created_at', Carbon::today());
        }

        if(isset($request->search)){
            $data->where('store','LIKE','%'.$request->search.'%')
                ->orWhere('brand','LIKE','%'.$request->search.'%')
                ->orWhere('product_name','LIKE','%'.$request->search.'%')
                ->orWhere('product_category','LIKE','%'.$request->search.'%');
        }

        $reports = $data->orderBy('created_at', 'desc')->paginate(10);

        return view('report.sales_summary', compact('reports'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application
     * |\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function totalSales()
    {
        $reports = Sale::orderBy('created_at', 'desc')->paginate(10);
        return view('report.total_sales', compact('reports'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application
     * |\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function order(Request $request)
    {
        $orders = $this->orderQuery($request, 'order');
        return view('report.order', compact('orders'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application
     * |\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function payment(Request $request)
    {
        $orders = $this->orderQuery($request, 'payment');
        return view('report.payment', compact('orders'));
    }

    /**
     * @param $request
     * @param $search_type
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function orderQuery($request, $search_type)
    {
        $data = Order::query();
        if(isset($request->start_date) || isset($request->end_date)){
            $from = $request->start_date ?? Carbon::today()->subDays(30);
            $to = $request->end_date ?? Carbon::today();
            $data->whereBetween(DB::raw('DATE(created_at)'), array($from, $to))->get();
        }

        if(isset($request->search)){
            if($search_type == 'order'){
                $data->where('status','LIKE','%'.$request->search.'%');
            }
            if($search_type == 'payment'){
                $data->where('paid_by','LIKE','%'.$request->search.'%');
            }
        }
        return $data->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        return Excel::download(new SalesExport(), 'sales-report-'.time(). '.xlsx');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function filterExport(Request $request)
    {
        $search = $request->search;
        $from = $request->start_date;
        $to = $request->end_date;

        return Excel::download(new SalesFilterExport($search, $from, $to), 'filter-sales-report-'.time(). '.xlsx');
    }
}
