<?php

namespace App\Http\Controllers;

use App\Exports\UsersDataExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Log;
use App\Events\UserLog;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index() {
        $users = User::orderBy('id')->get();

        return view('users.userlist', [
            'users' => $users
        ]);
    }

    public function exportExcel() {
        return Excel::download(new UsersDataExport, 'users-data.xlsx');
    }

    public function store(Request $request)
    {
        // abort_if(Gate::denies('create user'), 403);
        abort_if(Gate::denies('create user'), 403);
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $users = User::create($validatedData);

        $log_entry = 'Added a new user "' . $users->name . '" with the ID of ' . $users->id;
        event(new Userlog($log_entry));

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function create(User $user) {
        abort_if(Gate::denies('create user'), 403);
        return view('users.create', compact('user'));
    }

    public function edit(User $user) {
        abort_if(Gate::denies('update user'), 403);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        abort_if(Gate::denies('edit user'), 403);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->update($request->only('name', 'email', 'password'));

        $log_entry = 'Updated a new user "' . $user->name . '" with the ID of ' . $user->id;
        event(new Userlog($log_entry));

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }


    public function destroy(User $user) {
        abort_if(Gate::denies('delete user'), 403);
        $user->delete();

        $log_entry = 'Deleted a new user "' . $user->name . '" with the ID of ' . $user->id;
        event(new Userlog($log_entry));

        return redirect()->route('user.index');
    }

    public function logs() {
        abort_if(Gate::denies('visit logs'), 403);
        $logs = Log::all();
        return view('logs', compact('logs'));
    }
}