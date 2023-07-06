<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\sale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total = 0;
        $due = 0;
        $check = [];
        $sales = sale::all();

        foreach ($sales as $s) {
            // Check if the order_id already exists in the $check array
            if (in_array($s->order_id, $check)) {
                continue; // Skip this iteration and move to the next one
            } else {
                if ($s->due == 0) {
                    $total += $s->total_price;
                } else {
                    $dueLocal = $s->due;
                    $due += $s->due;
                    $ss = sale::where('order_id', $s->order_id)->get();
                    $sumDue = 0;
                    foreach ($ss as $sum) {
                        $sumDue += $sum->total_price;
                    }
                    $sumDue = $sumDue - $dueLocal;
                    $total += $sumDue;
                }
                array_push($check, $s->order_id);
            }
        }

        $customer = 0;
        $cust = customer::all();
        foreach ($cust as $c) {
            $customer += 1;
        }
        return view('home', compact('total', 'customer', 'due'));
    }
}
