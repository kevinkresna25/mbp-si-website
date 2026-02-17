<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::all()->groupBy('group');

        return view('admin.site-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = SiteSetting::all();

        foreach ($settings as $setting) {
            $newValue = $request->input("settings.{$setting->key}");

            if ($newValue !== null && $newValue !== $setting->value) {
                $setting->update(['value' => $newValue]);
            }
        }

        SiteSetting::clearCache();

        return redirect()->route('admin.site-settings.index')
            ->with('success', 'Pengaturan situs berhasil diperbarui.');
    }
}
