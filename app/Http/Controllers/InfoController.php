<?php

namespace App\Http\Controllers;

use App\Http\Requests\Info\InfoRequest;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function index(InfoRequest $request)
    {
        $data = $request->validated();

        $products = ProductDetail::where('product_id', $data['product_id'])
            ->where('date', '<=', $data['date'])
            ->orderBy('quantity', 'asc')->get();
        $product = Product::where('id', $data['product_id'])->first();
        $order = $this->dateValid($data['date']);

        if (is_numeric($order)) {
            setcookie('date', $_COOKIE['date'] + 86400);

            foreach ($products as $value) {
                if ($value->quantity >= $order) {
                    $p = ProductDetail::find($value->id);
                    $p->update([
                        'quantity' => $value->quantity - $order
                    ]);
                    $quantityBest = $product->quantity - $order;
                    $product->update([
                        'quantity' => $quantityBest
                    ]);
                    return response([
                        'date' => $data['date'],
                        'quantity' => $quantityBest,
                        'price' => $value->price,
                    ]);
                }
            }
            return response(['message' => "I can't find one price", 'products' => $products], 455);
        } else {
            return $order;
        }


    }

    private function fib($n)
    {
        if ($n === 0) return 1;
        if ($n === 1) return 1;
        $one = 0;
        $two = 1;
        $current = 0;
        for ($i = 1; $i < $n; $i++) {
            $current = $one + $two;
            $one = $two;
            $two = $current;
        }
        return $current;
    }

    private function dateValid($date)
    {
        $dateStart = mktime(0, 0, 0, 01, 13, 2021);
        if (!isset($_COOKIE['date'])) {
            setcookie('date', $dateStart);
            $_COOKIE['date'] = $dateStart;
        }
        $date = explode('-', $date);

        $d = mktime(0, 0, 0, $date[1], $date[2], $date[0]);
        if ($d != (int)$_COOKIE['date']) {
            return response(['message' => 'wrong date'], 455);
        } else {
            $n = ($d - $dateStart) / (24 * 60 * 60);
        }

        return $this->fib($n);
    }
}
