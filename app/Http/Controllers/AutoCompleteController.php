<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class AutoCompleteController extends Controller
{
    public function index(){
        return view('autocomplete.index');
    }

    public function autoComplete(Request $request) {
        $query = $request->get('term','');

        $products=Product::where('name','LIKE','%'.$query.'%')->get();

        $data=array();
        foreach ($products as $product) {
            $data[]=array('value'=>$product->name,'id'=>$product->id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No Result Found','id'=>''];
    }
}
