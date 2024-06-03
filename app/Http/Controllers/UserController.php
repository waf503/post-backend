<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index():JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }
    public function show(User $user):JsonResponse{
        return response()->json($user);
    }
    public function store(Request $request):JsonResponse{
        return response()->json(["message"=>"ok"]);
    }
    public function update(Request $request, User $user):JsonResponse{
        return response()->json(["message"=>"update"]);
    }
    public function destroy(Request $request, User $user):JsonResponse{
        return response()->json(["message"=>"destroy"]);
    }
}
