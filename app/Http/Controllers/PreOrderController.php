<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PreOrderController extends Controller
{
    public function showPreOrder($id)
    {
        $data = Product::where('id', $id)->first();
        if ($data == null) return redirect()->route('home');
        else return view('preorder.detail.detail', compact('data'));
    }

    public function showPreOrderList(Request $request)
    {
        $data = Transaction::whereBelongsTo($request->user())->get();
        return view('preorder.preorder', compact('data'));
    }

    public function checkoutPreOrder(Request $request)
    {
        $transaction = new Transaction();
        $transaction->user_id = $request->user()->id;
        $transaction->product_id = $request->input('id');
        $transaction->option = $request->input('option');
        $transaction->qty = $request->input('qty');
        $transaction->save();
        return redirect()->route('transactions');
    }
}
