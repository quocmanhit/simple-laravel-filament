<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use View;
class BaseInsideController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $_ref;

    public function __construct()
    {
        $this->_ref = Request()->get('_ref', null);

        View::share('title', '');
        View::share('description', '');
        View::share('keywords', '');
        View::share('author', '');
        View::share('current_url', url()->current());
    }
}
