<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return $this->response->array([
            'code' => 1,
            'msg' => 'this is index page.'
        ])->setStatusCode(201);
    }
}
