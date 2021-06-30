<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
Use voku\helper\HtmlDomParser;

class TestControllers extends Controller
{
    public function index(){
        $brand =  new Brand();
       $brand->BrandListAdd('https://www.wildberries.ru/brands/podarok52-112777', 1);
    }
}
