<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = auth()->user()->setting; 
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'feeds_per_row' => 'required|integer|min:1|max:5', 
        ]);

        $setting = auth()->user()->setting;

     
        if (!$setting) {
            $setting = new Setting();
            $setting->user_id = auth()->id();
        }

       
        $setting->feeds_per_row = $request->feeds_per_row;
        $setting->save();

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}