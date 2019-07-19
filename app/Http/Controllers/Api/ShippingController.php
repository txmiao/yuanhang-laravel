<?php

namespace App\Http\Controllers\Api;

use App\Models\Shipping;
use App\Transformers\ShippingTransformer;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    //
    public function index(){
        $shippings=Shipping::active()->orderBy('sort','asc')->get();

        return $this->response->collection($shippings,new ShippingTransformer());
    }
}
