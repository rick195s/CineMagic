<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function  __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->cannot('viewAny', User::class)) {
            return redirect(route('home'));
        }
        $users = User::paginate(15);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Mostrar as informações do user no dashboard.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        $this->authorize('view', $user);
        // if (Auth::user()->cannot('view', $user)) {
        //     return redirect(route('home'));
        // }

        dump($user);
        return view('home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remover um utilizador através do dashboard.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // findOrFail já retira os users com softDeletes
        $user = User::findOrFail($id);

        try {
            $this->authorize('delete', $user);
            // soft delete
            $user->delete();
            return back()->with('success', __('User Deleted'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }

        // $request->merge([
        //     'id' => $id,
        //     'authUserId' => strval(Auth::user()->id)
        // ]);
        // $request->validate([
        //     'id' => [
        //         "required",
        //         "different:authUserId",
        //     ]
        // ]);

        // if (Auth::user()->id == $user->id) {
        //     return back()->withErrors(['message' => 'User não se pode eliminar a ele proprio']);
        // }

    }
}
