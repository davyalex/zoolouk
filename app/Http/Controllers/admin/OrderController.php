<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    //get all order
    public function getAllOrder(){
        // dd(Carbon::today());
        $orders = Order::orderBy('created_at','DESC')
        // ->when(request('d'), fn($q)=>$q->where('created_at' ,Carbon::today()))
        ->when(request('s'), fn($q)=>$q->whereStatus(request('s')))
        ->get();

        return view('admin.pages.order.order',compact(['orders']));
     }
 
     //show order     
      // detail of order user
    public function showOrder($id){

        $orders= Order::whereId($id)
        ->with(['user','products'
            =>fn($q)=>$q->with('media')
        ])
        ->orderBy('created_at','DESC')->first();
        // dd($orders->toArray());
        return view('admin.pages.order.order_show',compact('orders'));
    }

    public function invoice($id){

        $orders= Order::whereId($id)
        ->with(['user','products'
            =>fn($q)=>$q->with('media')
        ])
        ->orderBy('created_at','DESC')->first();
        // dd($orders->toArray());
        return view('admin.pages.order.invoice',compact('orders'));
    }


    //change state
    public function changeState(Request $request){
        $state = request('cs');
        $orderId = request('id');

        $changeState = Order::whereId($orderId)->update([
            'status'=>$state
        ]);

        if ($state=='livrée') {
            $changeState = Order::whereId($orderId)->update([
                'delivery_date'=>carbon::now()
            ]);
        }

        return back()->withSuccess('statut changé avec success');



       


    }
      
}
