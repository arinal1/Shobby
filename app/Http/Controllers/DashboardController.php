<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        return view('dashboard.dashboard')
            ->with('users', User::all())
            ->with('transactions', Transaction::all())
            ->with('products', Product::all());
    }

    public function showUserDetail($id = '')
    {
        $operation = '';
        $data = null;
        if ($id == '') $operation = 'add';
        else {
            $operation = 'edit';
            $data = User::where('id', $id)->first();
        }
        session(['operation' => $operation]);
        return view('dashboard.users.detail.detail')->with('data', $data);
    }

    public function saveUserDetail(Request $request)
    {
        $user = null;
        if (session('operation') == 'edit') {
            $user = User::where('id', $request->id)->first();
        } else {
            $user = new User();
            $user->id = $request->id;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->password != null) {
            $user->password = Hash::make($request->password);
        }

        try {
            $user->save();
            if ($user->id == Auth::user()->id && $request->password != null) {
                Auth::logout();
            }
            return redirect(route('dashboard') . '#user-tab');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyimpan data');
            return redirect()->back();
        }
    }

    public function deleteUser(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user != null) {
            try {
                $user->delete();
                session()->flash('success', 'Berhasil menghapus data user');
                return redirect(route('dashboard') . '#user-tab');
            } catch (\Exception $e) {
                session()->flash('error', 'Gagal menghapus data user');
                return redirect(route('dashboard') . '#user-tab');
            }
        } else {
            session()->flash('error', 'Data user yang akan dihapus tidak ada');
            return redirect(route('dashboard') . '#user-tab');
        }
    }

    public function showProductDetail($id = '')
    {
        $operation = '';
        $data = null;
        if ($id == '') $operation = 'add';
        else {
            $operation = 'edit';
            $data = Product::where('id', $id)->first();
        }
        session(['operation' => $operation]);
        return view('dashboard.products.detail.detail')->with('data', $data);
    }

    public function saveProductDetail(Request $request)
    {
        $product = null;
        if (session('operation') == 'edit') {
            $product = Product::where('id', $request->id)->first();
        } else {
            $product = new Product();
            $product->id = $request->id;
        }
        $product->name = $request->name;
        $product->volume = $request->volume;
        $product->description = $request->description;
        $product->publisher = $request->publisher;
        $product->status = $request->status;
        $product->price = $request->price;

        if ($request->hasFile('image')) {
            $image = $request->image;
            $fileName = $request->id . '__' . $request->name . '__' . substr($image->getClientOriginalName(), -6);
            $path = $image->move('img/product', $fileName);
            $product->image = $path;
        }

        try {
            $product->save();
            return redirect(route('dashboard') . '#product-tab');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyimpan data');
            return redirect()->back();
        }
    }

    public function deleteProduct(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        if ($product != null) {
            try {
                $product->delete();
                session()->flash('success', 'Berhasil menghapus data produk');
                return redirect(route('dashboard') . '#product-tab');
            } catch (\Exception $e) {
                session()->flash('error', 'Gagal menghapus data produk');
                return redirect(route('dashboard') . '#product-tab');
            }
        } else {
            session()->flash('error', 'Data produk yang akan dihapus tidak ada');
            return redirect(route('dashboard') . '#product-tab');
        }
    }

    public function showTransactionDetail($id = '')
    {
        $operation = '';
        $data = null;
        if ($id == '') $operation = 'add';
        else {
            $operation = 'edit';
            $data = Transaction::where('id', $id)->first();
        }
        session(['operation' => $operation]);
        return view('dashboard.transactions.detail.detail')->with('data', $data);
    }

    public function saveTransactionDetail(Request $request)
    {
        $transaction = null;
        if (session('operation') == 'edit') {
            $transaction = Transaction::where('id', $request->id)->first();
        } else {
            $transaction = new Transaction();
            $transaction->id = $request->id;
        }
        $transaction->product_id = $request->product_id;
        $transaction->user_id = $request->user_id;
        $transaction->option = $request->option;
        $transaction->qty = $request->qty;

        try {
            $transaction->save();
            return redirect(route('dashboard') . '#transaction-tab');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal menyimpan data');
            return redirect()->back();
        }
    }

    public function deleteTransaction(Request $request)
    {
        $product = Transaction::where('id', $request->id)->first();
        if ($product != null) {
            try {
                $product->delete();
                session()->flash('success', 'Berhasil menghapus data transaksi');
                return redirect(route('dashboard') . '#transaction-tab');
            } catch (\Exception $e) {
                session()->flash('error', 'Gagal menghapus data transaksi');
                return redirect(route('dashboard') . '#transaction-tab');
            }
        } else {
            session()->flash('error', 'Data transaksi yang akan dihapus tidak ada');
            return redirect(route('dashboard') . '#transaction-tab');
        }
    }

}
