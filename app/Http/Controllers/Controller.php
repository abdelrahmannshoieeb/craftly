<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;








    public function practice()
    {
        //1
        //between two dates
        //get ->make collection
        $user = User::whereBetween('created_at', ['2022-02-01', '2024-08-28']);
        //if u want to get users with not paid orders and the orders too
        //notice the with accept arr
        $users1 = User::whereHas('orders', function ($query) {
            $query->where('total_status', 'notpaid');
        })->with(['orders' =>function ($query) {

            $query->where('total_status', 'notpaid');
        }]) ->get();

        //u can do it like this if total and upaid on users table
        // $users2 = User::where('total_status', 'notpaid')->with('orders')->get();

        //2
        $user3 = Order::where('user_id',1)->with('user')->get();

       //3 retrive array
        $names = User::pluck('name');

        //4
        $userOrder = User::orderBy('created_at', 'asc')->pluck('name');

        //5
        //make collection an array
        $user4 = User::find(1)->toArray();

        //6









       


        return view('welcome',
        [
            "UserWithOrdersTotalPaid" => $users1,
        ]);
    }
}
