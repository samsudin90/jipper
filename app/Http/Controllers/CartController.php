<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index() {
        $title = 'Cart';
        $user = Auth::user();

        return view('cart', compact('title', 'user'));
    }

    public function store(Request $request) {
        $user = Auth::user();
        
        $validated = $request->validate([
            'id' => 'required',
            'price' => 'required'
        ]);

        $cart = CartItem::create([
            'user_id' => $user->id,
            'product_id' => $request->id,
            'harga' => $request->price,
            'qty' => $request->quantity,
            'bahan' => $request->material,
            'total' => $request->price * $request->quantity,
            'design_only' => $request->design,
            'size' => $request->size
        ]);

        return redirect('/cart');
    }

    public function destroy($id) {
        $user = Auth::user();
        $cart = CartItem::findOrFail($id);
        if($user and $user->id === $cart->user_id) {
            $cart->delete();
        }

        return redirect('/cart');
    }

    public function increment($id) {
        $user = Auth::user();
        $cart = CartItem::findOrFail($id);
        if($user and $user->id === $cart->user_id) {
            $cart->increment('qty');
            $cart->save();
        }
        return redirect('/cart');
    }

    public function decrement($id) {
        $user = Auth::user();
        $cart = CartItem::findOrFail($id);
        if($user and $user->id === $cart->user_id) {

            if($cart->qty === 1) {
                $cart->delete();
            } else {
                $cart->decrement('qty');
                $cart->save();
            }
        }
        return redirect('/cart');
    }

    public function checkout(Request $request) {
        // dd($user->carts[0]->user_id);
        $title = 'Checkout';
        $user = Auth::user();

        // kuduna check hela user_id aya atau eweuh
        $detail = OrderDetail::create([
            'user_id' => $user->id,
            'note' => $request->note,
            'total_price' => $request->total,
            'status' => 'unpaid'
        ]);

        foreach ($user->carts as $item) {
            $bahan = '--';
            if(!empty($item->bahan)) {
                $bahan = $item->bahan;
            }
            OrderItem::create([
                'order_detail_id' => $detail->id,
                'product_id' => $item->product_id,
                'design_only' => $item->design_only,
                'bahan' => $bahan,
                'size' => $item->size,
                'harga' => $item->harga,
                'qty' => $item->qty,
                'total' => $item->total,
                'complete' => 0
            ]);
        }

        $cart = $user->carts;
        $cart->each->delete();

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $detail->id,
                'gross_amount' => $detail->total_price,
            ),
            'customer_details' => array(
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'phone' => $user->phone,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $order = $detail;

        // return redirect('/checkout/'.$detail->id);
        return view('shop.checkout', compact('title', 'user', 'order', 'snapToken'));

    }

    public function checkoutDetail($id) {
        $user = Auth::user();
        $order = OrderDetail::findOrFail($id);
        $title = 'Checkout';

        // dd($order->all());
        return view('shop.checkout', compact('title', 'user', 'order'));
    }

    public function invoice($id) {
        $order = OrderDetail::find($id);

        return view('shop.invoice', compact('order'));
    }

    public function callback(Request $request) {
        $serverKey = config('midtrans.server_key');

        $hashed = hash("sha512", $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if($hashed == $request->signature_key) {
            if($request->transaction_status == 'capture' or $request->transaction_status == 'settlement') {
                $order = OrderDetail::find($request->order_id);
                $order->update(['status' => 'paid']);
            }
        }
    }

}
