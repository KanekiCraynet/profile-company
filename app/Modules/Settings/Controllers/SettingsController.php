<?php

namespace App\Modules\Settings\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display the settings index page.
     */
    public function index()
    {
        $settings = Setting::orderBy('group')->orderBy('key')->get()->groupBy('group');
        $groups = ['general', 'company', 'seo', 'social', 'email', 'maps'];
        
        return view('admin.settings.index', compact('settings', 'groups'));
    }

    /**
     * Update settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'settings' => ['required', 'array'],
            'settings.*' => ['nullable', 'string'],
        ]);

        foreach ($validated['settings'] as $key => $value) {
            Setting::set($key, $value ?? '', 'string');
        }

        // Clear cache
        \Cache::flush();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Store a new setting.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => ['required', 'string', 'max:255', 'unique:settings,key'],
            'value' => ['nullable', 'string'],
            'type' => ['required', 'in:string,text,json,file'],
            'group' => ['required', 'in:general,company,seo,social,email,maps'],
        ]);

        Setting::create($validated);

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting created successfully.');
    }

    /**
     * Delete a setting.
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Setting deleted successfully.');
    }
}





