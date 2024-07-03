<?php

namespace App\Http\Controllers;

use App\Exports\UsersDataExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('id')->get();

        return view('userlist', [
            'users' => $users
        ]);
    }

    public function exportExcel() {
        return Excel::download(new UsersDataExport, 'users-data.xlsx');
    }
}
