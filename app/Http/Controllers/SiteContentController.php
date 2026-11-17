<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteContentController extends Controller
{
    public function edit()
    {
        $groups = [
            'home_hero' => __('Homepage — Hero'),
            'home_cars' => __('Homepage — Cars'),
            'home_stats' => __('Homepage — Numbers'),
            'home_why' => __('Homepage — Why us'),
            'contact' => __('Contact page'),
            'location' => __('Location page'),
            'social' => __('Social networks'),
        ];

        $settings = SiteSetting::query()
            ->orderBy('sort_order')
            ->get()
            ->groupBy('group');

        return view('admin.siteContent', compact('groups', 'settings'));
    }

    public function update(Request $request)
    {
        $items = $request->input('settings', []);

        foreach ($items as $id => $values) {
            $setting = SiteSetting::find($id);
            if (! $setting) {
                continue;
            }

            if ($setting->type === 'image') {
                $fileKey = "settings_files.$id";
                if ($request->hasFile($fileKey)) {
                    $path = $request->file($fileKey)->store('site', 'public');
                    $url = Storage::url($path);
                    $setting->value_az = $url;
                    $setting->value_en = $url;
                    $setting->value_ru = $url;
                } elseif (! empty($values['path'])) {
                    $path = $values['path'];
                    $setting->value_az = $path;
                    $setting->value_en = $path;
                    $setting->value_ru = $path;
                }
            } elseif (in_array($setting->type, ['url', 'number'], true)) {
                $shared = $values['value'] ?? $setting->value_en;
                $setting->value_az = $shared;
                $setting->value_en = $shared;
                $setting->value_ru = $shared;
            } else {
                $setting->value_az = $values['value_az'] ?? $setting->value_az;
                $setting->value_en = $values['value_en'] ?? $setting->value_en;
                $setting->value_ru = $values['value_ru'] ?? $setting->value_ru;
            }

            $setting->save();
        }

        SiteSetting::clearCache();

        $tab = $request->input('active_tab');

        return redirect()
            ->route('siteContent.edit', array_filter(['tab' => $tab]))
            ->with('success', __('Site content updated successfully.'));
    }
}
