<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;


class UserController extends Controller
{
	public function showUsers()
	{
		return view('components.AdminUsers.index');
	}
	public function getAllUsers()
	{
		$users = User::get();
		return response()->json(['users' => $users], 200);
	}

	public function getAllUsersWithShoppings()
	{
		$users = User::with('Shopping_Carts.Product')->has('Shopping_Carts.Product')->get();
		return response()->json(['users' => $users], 200);
	}

	public function getAnUser(User $user)
	{
		return response()->json(['users' => $user], 200);
	}

	public function createUser(CreateUserRequest $request)
	{
		$user = new User($request->all());
		$user->save();
		if ($request->ajax())
				return response()->json(['user' => $user], 201);

			return back()->with('success', 'Usuario Creado');
	}

	public function updateUser(User $user, UpdateUserRequest $request)
	{
		$user->update($request->all());
		return response()->json(['user' => $user->refresh()], 201);
	}

	public function deleteUser(User $user, Request $request)
	{
		$user->delete();
		return response()->json([], 204);
	}
}
