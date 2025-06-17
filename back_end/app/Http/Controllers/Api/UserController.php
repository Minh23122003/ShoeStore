<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Đăng ký tài khoản",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"username", "password", "name", "email", "address", "phone"},
     *             @OA\Property(property="username", type="string", example="nguyenvana"),
     *             @OA\Property(property="password", type="string", example="123"),
     *             @OA\Property(property="name", type="string", example="Nguyễn Văn A"),
     *             @OA\Property(property="email", type="string", example="nguyenvana@gmail.com"),
     *             @OA\Property(property="address", type="string", example="TPHCM"),
     *             @OA\Property(property="phone", type="string", example="0123456789"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Đăng ký thành công"
     *     )
     * )
     */
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
        ], [
            'username.unique' => 'Username already exists!',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->is_admin = false;
        $user->save();

        return response()->json(['message' => 'User created successfully'], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Đăng nhập tài khoản",
     *     tags={"Users"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"username", "password"},
     *             @OA\Property(property="username", type="string", example="user"),
     *             @OA\Property(property="password", type="string", example="123"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Đăng nhập thành công"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Đăng nhập thất bại"
     *     )
     * )
     */
    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if (! $user || ! Hash::check($request->password, $user->password)){
            return response()->json(['error' => 'Username or password is wrong!'], 401);
        }

        $token = $user->createToken('token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    /**
     * @OA\Get(
     *     path="/api/profile",
     *     summary="Lấy thông tin tài khoản",
     *     tags={"Users"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Thông tin tài khoản"
     *     )
     * )
     */
    public function profile(Request $request)
    {
        return $request->user();
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     summary="Đăng xuất tài khoản",
     *     tags={"Users"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Đăng xuất thành công"
     *     )
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out!']);
    }

}
