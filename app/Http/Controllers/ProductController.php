<?php

namespace App\Http\Controllers;


use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Ordernow;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //
    function index()
    {
        $data = Product::all();
        return view('product', ['products'=>$data]);
    }
    function detail($id)
    {
        $data= Product::find($id);
        return view('detail', ['details'=>$data]);
    }

    function addToCart(Request $req)
    {
        if($req->session()->has('user'))
        {
            $cart = new Cart;
            $cart->user_id=$req->session()->get('user')['id'];

            $cart->product_id=$req->product_id;
            $cart->save();
            return redirect('/');
            

        }
        else{
            return redirect('login');
        }
    }

    static function cartTotal()
    {
        $userID= Session::get('user')['id'];
        return Cart::where('user_id',$userID)->count();
  
    }

    function cartList()
    {
        $userId=Session::get('user')['id'];
        $products= DB::table('cart')
            ->join('products','cart.product_id','=','products.id')
            ->where('cart.user_id',$userId)
            ->select('products.*','cart.id as cart_id')
            ->get();

        return view('cartlist',['products'=>$products]);
    }
    function removeCart($id)
    {
        $id=Cart::destroy($id);
        return redirect('cartlist');
    }
    function orderNow()
    {
        $userId=Session::get('user')['id'];
        $total = DB::table('cart')
            ->join('products','cart.product_id','=','products.id')
            ->where('cart.user_id',$userId)
            ->select('products.*','cart.id as cart_id')
            ->sum('products.price');

        return view('ordernow',['totalPrice'=>$total]);
    }

    function orderPlace(Request $req)
    {
        $userId=Session::get('user')['id'];
        $allCart= Cart::where('user_id', $userId)->get();
        foreach($allCart as $cart)
        {
            $order = new Ordernow;
            $order->product_id = $cart['product_id'];
            $order->user_id = $cart['user_id'];
            $order->status = 'pending';
            $order->payment_method = $req->payment;
            $order->payment_status = 'pending';
            $order->address = $req->address;
            $order->save();
            Cart::where('user_id', $userId)->delete();

        }
        $req->input();
        return redirect('/');
    }

    function myOrder()
    {
        $userId=Session::get('user')['id'];
        $orders= DB::table('orders')
            ->join('products','orders.product_id','=','products.id')
            ->where('orders.user_id',$userId)
            ->get();
        
        return view('myorders',['myOrders'=>$orders]);
    }

    public function validate_product(Request $req)
    {   
        
        $id = $req->has('product_id')?$req->get('product_id'):'';
        // dd($id);
        $product_amount = Product::find($id)->amount;
        // dd($req->all());
        
        if($req->has('qty') && $req->get('qty')>$product_amount)
        {
            return json_encode([
                'success' => true,
                'message' => 'Products Quantity must be less than' . $product_amount,
            ]);
        }else{
            return json_encode([
                'success' => false,
            ]);
        }


    }
    
}
