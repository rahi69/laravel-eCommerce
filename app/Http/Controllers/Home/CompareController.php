<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function index(){
        if (session()->has('compareProducts')){

            $products = Product::findOrFail(session()->get('compareProducts'));

            return view('home.compare.index',compact('products'));
        }
        alert()->warning('ابتدا باید محصولی را به لیست مفایسه خود اضافه کنید', 'دقت کنید');
        return redirect()->back();
    }

    public function add(Product $product)
    {
        if(session()->has('compareProducts'))
        {
            if(in_array( $product->id , session()->get('compareProducts')))
            {
                alert()->warning('محصول مورد نظر به لیست مقایسه های شما اضافه شده است', 'دقت کنید');
                return redirect()->back();
            }
            session()->push('compareProducts',$product->id);
        }else{
            session()->put('compareProducts',[$product->id]);
        }
        alert()->success('محصول مورد نظر به لیست مقایسه شما اضافه شد', 'باتشکر');
        return redirect()->back();
    }

    public function remove($productId)
    {
        if (session()->has('compareProducts')) {
            foreach (session()->get('compareProducts') as $key => $item) {
                if ($item == $productId) {
                    session()->pull('compareProducts.' . $key);
                }
            }
            if(session()->get('compareProducts') == []){
                session()->forget('compareProducts');
                return redirect()->route('home.index');
            }

            return redirect()->route('home.compare.index');
        }
        alert()->warning('ابتدا باید محصولی را به لیست مفایسه خود اضافه کنید', 'دقت کنید');
        return redirect()->back();
    }
}
