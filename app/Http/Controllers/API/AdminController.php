<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function getUsers()
    {
        $users = User::with('roles')->get();

        return response()->json([
            'message' => 'All users retrieved successfully',
            'data' => $users
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $id,
            'image' => 'nullable|string',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email', 'image'));

        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user,
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'User soft deleted successfully',
        ]);
    }

    public function getTrashedUsers(Request $request)
    {
        $query = User::onlyTrashed()->with('roles');

        // Optional search by name or email
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(10);

        return response()->json($users);
    }

    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return response()->json([
            'message' => 'User restored successfully',
            'user' => $user->load('roles')
        ]);
    }

}
