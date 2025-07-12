<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profile = $user->profile;
        
        return view('profile.index', compact('profile'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'telepon' => 'required|string',
        ]);

        $user = Auth::user();
        
        // Update atau create profile
        UserProfile::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->route('user.profile')->with('success', 'Profile berhasil disimpan!');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
            'telepon' => 'required|string',
        ]);

        $user = Auth::user();
        $profile = $user->profile;

        if ($profile) {
            $profile->update($validated);
        } else {
            UserProfile::create(array_merge($validated, ['user_id' => $user->id]));
        }

        return redirect()->route('user.profile')->with('success', 'Profile berhasil diupdate!');
    }
}