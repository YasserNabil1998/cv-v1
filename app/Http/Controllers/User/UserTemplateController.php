<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserTemplateSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserTemplateController extends Controller
{
    public function saveSettings(Request $request)
    {
        $validated = $request->validate([
            'template_name' => 'required|string',
            'font_family' => 'required|string',
            'font_color' => 'required|string',
            'heading_color' => 'required|string',
        ]);

        // حفظ البيانات باستخدام الموديل
        $setting = UserTemplateSetting::updateOrCreate(
            ['template_name' => $request->template_name],
            [
                'font_family' => $request->font_family,
                'font_color' => $request->font_color,
                'heading_color' => $request->heading_color,
            ]
        );

        return response()->json(['message' => 'Settings saved successfully!']);
    }


    public function getSettings($templateName)
    {
        // استرجاع الإعدادات للمستخدم الحالي
        $settings = UserTemplateSetting::where('template_name', $templateName)
            ->where('user_id', auth()->id) // استخدم auth() للحصول على المستخدم الحالي
            ->first();

        if ($settings) {
            return response()->json([
                'font_family' => $settings->font_family,
                'font_color' => $settings->font_color,
                'heading_color' => $settings->heading_color
            ]);
        } else {
            return response()->json(['error' => 'Settings not found'], 404);
        }
    }

    public function showTemplateSettings()
    {
        // استرجاع الإعدادات من قاعدة البيانات
        $settings = UserTemplateSetting::where('template_name', 'template_1')
            ->where('user_id', auth()->id) // تأكد من أن المستخدم الذي يسجل الدخول هو من قام بتخصيص الإعدادات
            ->first();

            dd($settings);

        // إرسال البيانات إلى الـ View
        return view('user.pages.editor', compact('settings'));
    }
}
