<?php

namespace App\Http\Controllers;

 use App\Models\User;
class UserController extends Controller
{
   

public function index()
{
    $users = User::all();
    return view('users.index', compact('users'));
}

public function show(string $id)
{
    $user = User::findOrFail($id);
    return view('users.show', compact('user'));
}

public function destroy(string $id)
{
    User::destroy($id);
    return redirect()->route('users.index');
}
}
