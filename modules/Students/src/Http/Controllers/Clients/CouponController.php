<?php

namespace Modules\Students\src\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function __construct() {}
    public function verify(Request $request)
    {
        $coupon = $request->coupon;
        return [$coupon];
    }
}