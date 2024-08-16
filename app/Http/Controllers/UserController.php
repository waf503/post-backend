<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index():JsonResponse
    {
        event(new UserCreated(User::factory()->make()));
       // $users = User::query()->get();
        return response()->json([
            "message" => "hello"
        ]);
    }
    public function show(User $user):JsonResponse{
        return response()->json($user);
    }
    public function store(Request $request):JsonResponse{
        return DB::transaction(function () use ($request){
           $created = User::query()->create([
              'name' => $request->input('name'),
              'email'=>$request->input('email')
           ]);
           event(new UserCreated($created));
           return $created;
        });
    }
    public function update(Request $request, User $user):JsonResponse{
        return response()->json(["message"=>"update"]);
    }
    public function destroy(Request $request, User $user):JsonResponse{
        return response()->json(["message"=>"destroy"]);
    }
}
