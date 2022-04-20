<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home()
    {
        if (auth()->user()->role == 0) {
            return redirect('admin/dashboard');
        }
        elseif(auth()->user()->role == 1){
            return redirect('resepsionis/dashboard');
        }
        else{
            return auth()->logout();
        }
    }
}
