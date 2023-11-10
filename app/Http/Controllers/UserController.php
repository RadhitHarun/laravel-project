<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        Paginator::useBootstrap();
        $user = User::where(function($query) use ($search) 
        {
            $query  ->Where('name', 'LIKE', "%$search%")
                    ->orWhere('level', 'LIKE', "%$search%")
                    ->orWhere('email', 'LIKE', "%$search%");
        })->simplePaginate(10);
        
        return view('profile.index', compact('user','search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $user = $request->all();
    //     User::create($user);

    //     return redirect()->route('profile')->with('success','Profile Berhasil Disimpan');
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = [
            'name'   => $request->name,
            'id_mch' => $request->id_mch,
            'email'  => $request->email,
            'level'  => $request->level,
            'sub'    => $request->sub
        ];
    
        // Update password only if it's provided
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
    
        $user->update($data);
    
        return redirect()->route('profile')->with('success', 'Profile Berhasil Di Update');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('data')->with('success','Profile Berhasil Dihapus');
    }

    public function showRegistrationForm()
    {
        // return view('auth.register');
        return view('profile.create');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name'      => 'required',
            'id_mch'    => 'required',
            'sub'       => 'required',
            'email'     => 'required|email',
            'password'  => 'required|confirmed',
            'level'     => 'required'
        ])->validate();

        User::create([
            'name'      => $request->name,
            'id_mch'    => $request->id_mch,
            'sub'       => $request->sub,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'level'     => $request->level
        ]);

        return redirect()->route('profile')->with('success','Akun Berhasil Dibuat');
    }
}
