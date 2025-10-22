<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function dashboard()
    {
        return view('templates/admin_dashboard', [
            'username' => session()->get('username')
        ]);
    }
}
