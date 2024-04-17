<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function index()
    {
        $role = Role::all();
        $data = array(
            'role' => $role
        );
        return view('user.user', $data);
    }

    public function getDataUser(Request $request)
    {
        // $user = User::all();
        $user = DB::table('users')
                    ->leftJoin('roles', 'users.role', '=', 'roles.id')
                    ->select('users.*','roles.name as role_name')
                    ->get();

        $data = array(
            'user' => $user
        );

        $response = array(
            'success' => true,
            'exp' => session()->token(),
            'rec' => $request->header('X-CSRF-TOKEN'),
            'content' => view('user.table', $data)->render()
        );

        return response()->json($response);
    }

    public function createDataUser(Request $request)
    {
        $input = $request->all();
        $params = array(
            'name' => $input['fullname'],
            'email' => $input['email'],
            'role' => $input['role'],
            'password' => bcrypt($input['password']),
            'created_by' => auth()->id()
        );
        $create = User::create($params);
        return response()->json(['success' => true, 'message' => 'Pengguna berhasil dibuat', 'user' => $create]);
    }

    public function getUserById($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function editDataUser(Request $request)
    {
        $formData = $request->all();

        $user = User::findOrFail($formData['user_id']);
        $user->name = $formData['fullname'];
        $user->role = $formData['role'];
        $user->email = $formData['email'];
        $user->updated_by = auth()->id();

        if (!is_null($formData['password'])) {
            $user->password = bcrypt($formData['password']);
        }

        $user->save();
        return response()->json(['success' => true, 'message' => 'Pengguna berhasil diperbarui']);
    }

    public function softDelete($id)
    {
        $user = User::findOrFail($id);
        $user->deleted_by = auth()->id();
        $user->save();

        $user->delete();

        return response()->json(['success' => true, 'message' => 'User berhasil dihapus secara lunak']);
    }
}
