<?php

namespace App\Http\Controllers;

use App\Mail\InfoOrderShipped;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerifyCode;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderVerify;

use App\Utils\CommonUtil;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    public function addCart($id, Request $request)
    {
        //get data from SESSION
        $carts = empty(Session::get('carts')) ? [] : Session::get('carts');
        //dd($carts);
        // trùng product
        $quantity = $request->quantity;
        if (!empty($carts)) {
        foreach ($carts as $cart) {
            if($cart['id'] == $id){
                $newQuantity = $cart['quantity'];
                $quantity += $newQuantity;
            }
            }
        }
       else{
            $quantity = $request->quantity;
        }
       // dd( $quantityNew);

         //// get quantity from Form Request
        //  $quantity = $request->quantity;

         // get quantity from data
         $product = Product::findOrFail($id);
         $quantityDB = $product->quantity;

         if ($quantity <= $quantityDB) {
            $Product = [
                'id' => $id,
                'quantity' => $quantity,
                'price_id' => $request->price_id,
                'promotion_id' => $request->promotion_id
            ];

            $carts[$id] = $Product;
            // set data for SESSION
            session(['carts' => $carts]);
            //dd($carts);
            return redirect()->route('cart.cart-info')
                ->with('success', 'Add Product to Cart successful!');

        }else{
            return redirect()->back()->with('error','Please re-enter the quantity!');
        }
    }

    public function getCartInfo(Request $request)
    {

        //get cart info from SESSION
        $carts = empty(Session::get('carts')) ? [] : Session::get('carts');
        //dd($carts);
        // $data['carts'] = $carts;
        $total = 0;

        $products = [];
        if (!empty($carts)) {
            // create list product id
            $listProductId = [];
            foreach ($carts as $cart) {
                $listProductId[] = $cart['id'];
            }
            //dd( $listProductId);

            // get data product from list product id
            $products = Product::whereIn('id', $listProductId)
            ->get();

            // add step by step to SESSION
            //session(['step_by_step' => 1]);
        }
        //dd($products);
       return view('carts.cart_info', compact('products','carts','total'));

    }

    public function updateCart(Request $request)
    {
        //get data from SESSION
        $carts = empty(Session::get('carts')) ? [] : Session::get('carts');


        // get quantity from Form Request
       $quantity = $request->all();
       //dd($quantity);
       if (!empty($carts)) {
            foreach( $quantity['cart_quantity'] as $key => $qty){

                // get quantity from data
                $product = Product::findOrFail($key);
                $quantityDB = $product->quantity;
                // so sánh
                if($qty<=$quantityDB){
                    foreach ($carts as $id => $value) {
                        if ($value['id'] == $key) {
                            $carts[$id]['quantity'] = $qty;
                        }
                    }
                }
                else{
                    return redirect()->back()->with('error','Quantity exceeds stock. Please re-enter the quantity !');
                }
            }
            //update session
            session(['carts' => $carts]);
            //dd($carts);
            return redirect()->back()->with('success','Update quantity success!');
        }
    }
    public function removeCart($id,Request $request)
    {
        //get data from SESSION
        $carts = empty(Session::get('carts')) ? [] : Session::get('carts');
        //dd($carts);

        //delete item
        Arr::pull($carts, $id);

        // store session
        session(['carts' => $carts]);
        //dd($carts);
        return redirect()->route('cart.cart-info');
    }

    public function checkout(Request $request)
    {
        //get cart info from SESSION
        $carts = empty(Session::get('carts')) ? [] : Session::get('carts');
        $total = 0;
        $products = [];
        if (!empty($carts)) {
            // create list product id
            $listProductId = [];
            foreach ($carts as $cart) {
                $listProductId[] = $cart['id'];
            }
            //dd( $listProductId);
            // get data product from list product id
            $products = Product::whereIn('id', $listProductId)
            ->get();
        }
        //dd($products);
        return view('carts.checkout', compact('carts','products','total'));
    }

    public function checkoutComplete(Request $request)
    {
        $data = [];
        // get cart info
        $carts = Session::get('carts');
        //dd( $carts);

        // create data to save into table orders
        $dataOrder = [
            'user_id' => Auth()->id(),
            'status' => Order::STATUS[0],
            'payment'=>$request->payment_method,
        ];

        //dd(  $dataOrder );

        DB::beginTransaction();

        try {
            //save data into table orders
            $order = Order::create($dataOrder);
            $orderId = $order->id;
           //$orderId = 26;


            if (!empty($carts)) {
                foreach ($carts as $cart) {
                    $productId = $cart['id'];
                    $quantity = $cart['quantity'];
                    $priceId = $cart['price_id'];
                    $promotionId = $cart['promotion_id'];

                    $orderDetail = [
                        'product_id' => $productId,
                        'order_id' => $orderId,
                        'price_id' => $priceId,
                        'promotion_id' => $promotionId,
                        'quantity' => $quantity,
                    ];
                    //dd( $orderDetail);
                    // save data into table order_details
                    OrderDetail::create($orderDetail);


                    // $product = Product::findOrFail($orderId);
                    // $quantityDB = $product->quantity;
                    // $quantity_re = $quantityDB-$quantity;
                    // $product->quantity= $quantity_re;
                    // $product->save();

                }

            }
            //
            DB::commit();

            // remove session carts
            $request->session()->forget('carts');

            //data into mail
            $order_details =  DB::table('order_details')->where('order_id','=',$orderId )
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('prices', 'order_details.price_id', '=', 'prices.id')
            ->leftjoin('promotions','order_details.promotion_id','=','promotions.id')
            ->select('products.thumbnail','products.name',  'prices.price','order_details.quantity','promotions.discount')
            ->get();

            $order= DB::table('orders')->where('orders.id','=',$orderId)
            ->join('users','orders.user_id','=','users.id')
            ->select('orders.id','orders.payment','orders.created_at','users.name','users.address','users.phone')
            ->first();

            // $data['order']=$order;
            $email = Auth::user()->email;
            $data = [
               'order_details'=>$order_details,
               'order'=>$order,
           ];
           //dd($data);

            // send mail info order
            Mail::send('emails.orders.info_order_shipped', $data, function ($message) use($email) {
                $message->to($email)->subject('Send Order Info');
            });

            return redirect()->route('cart.order-complete')->with('success', 'Your Order was successful!');
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function orderComplete(){
        return view('carts.order_complete');
    }

    public function sendVerifyCode(Request $request)
    {
        // send code to verify Order
        // check exist send code ?
        $userId = Auth::id();
        $email = Auth::user()->email;
        $currentDate = date('Y-m-d H:i:s');
        $dateSubtract15Minutes = date('Y-m-d H:i:s', (time() - 60 * 15)); // current - 15 minutes
        Log::info('dateSubtract15Minutes');
        Log::info($dateSubtract15Minutes);
        $orderVerify = OrderVerify::where('user_id', $userId)
            ->whereBetween('expire_date', [$dateSubtract15Minutes, $currentDate])
            ->where('status', OrderVerify::STATUS[0])
            ->first();

        //dd($orderVerify);

        if (!empty($orderVerify)) { // already sent code and this code is available
            return response()->json(['message' => 'We sent code to your email about 15 minutes ago. Please check email to get code.']);
        } else { // not send code
            $dataSave = [
                'user_id' => $userId,
                'status'  => OrderVerify::STATUS[0], // default 0
                'code'  => CommonUtil::generateUUID(),
                'expire_date'  => $currentDate,
            ];
            DB::beginTransaction();

            try {
                OrderVerify::create($dataSave);

                // commit insert data into table
                DB::commit();

                // send code to email
                Mail::to($email)->send(new SendVerifyCode($dataSave));

                return response()->json(['message' => 'We sent code to email. Please check email to get code.']);

            } catch (\Exception $exception) {
                // rollback data and dont insert into table
                DB::rollBack();

                return response()->json(['message' => $exception->getMessage()]);
            }
        }
    }

    public function confirmVerifyCode(Request $request)
    {
        $code = $request->code;
        $userId = Auth::id();

        $orderVerify = OrderVerify::where('code', $code)
            ->where('user_id', $userId)
            ->where('status', OrderVerify::STATUS[0])
            ->first();
        //  validate code

        //dd($orderVerify );

        DB::beginTransaction();

        try {
            $orderVerify->status = OrderVerify::STATUS[1];
            //dd($orderVerify );
            $orderVerify->save();
            DB::commit();
            return response()->json(['message' => 'Confirmed code is OK.']);
        } catch (\Exception $exception) {
            DB::rollBack();

            return response()->json(['message' => $exception->getMessage()]);
        }
    }




}
