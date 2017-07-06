<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Seeder;

class SuperUserController extends Controller {
    public function generateLecturer()
    {
        \Artisan::call('db:seed', ['--class' => 'InitiateLecturer']);
    }

    public function showResetPassword()
    {
        
    }
}
