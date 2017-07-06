<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Input;

class SuperUserController extends Controller {
    public function generateLecturer()
    {
        \Artisan::call('db:seed', ['--class' => 'InitiateLecturer']);

        return "success";
    }

    public function showResetPassword()
    {
        return view('superuser.reset-password');
    }

    public function resetPassword()
    {
        $input = Input::get();
        $user = User::where('nidn', $input['nidn'])->first();
        if (! is_null($user))
        {
            $user->password = bcrypt($input['password']);
            $saved = $user->save();
            if ($saved)
            {
                return "Password changed";
            }
        }

        return "Something Wrong";
    }
}
