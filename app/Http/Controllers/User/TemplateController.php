<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class TemplateController extends Controller
{
    // دالة لاختيار وتحديث القالب
    public function selectTemplate($templateName, Request $request)
    {
        $userId = Auth::id();

        // البحث عن القالب للمستخدم بناءً على اسم القالب
        $template = Template::where('user_id', $userId)
            ->where('template_name', $templateName)
            ->first();

        if ($template) {
            // تحديث القالب إذا كان موجودًا
            $template->update([
                'is_preview' => !$template->is_preview, // التبديل بين "إضافة" و "معاينة"
            ]);
        } else {
            // إضافة القالب الجديد
            Template::create([
                'user_id' => $userId,
                'template_name' => $templateName,
                'url' => $templateName . '-' . $userId, // إنشاء رابط للقالب
                'is_preview' => true, // تعيينه كـ "معاينة" عند إضافته لأول مرة
            ]);
        }

        // إرجاع استجابة JSON
        return response()->json(['success' => true]);
    }

    // دالة لتصدير PDF للقالب
    public function exportPDF($templateName)
    {
        // استبدل 'view-name' باسم الـ View الذي يحتوي على تصميم الـ PDF
        $data = ['templateName' => $templateName]; // بيانات تمرر إلى الـ View
        $pdf = Pdf::loadView('user.pages.cvDesign', $data);

        // اسم الملف المراد تنزيله
        $fileName = $templateName . '.pdf';

        // تنزيل الملف
        return $pdf->download($fileName);
    }

    // دالة لتحديث رابط السيرة الذاتية
    public function updateSettings(Request $request)
    {

        // التحقق من المدخلات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'password' => 'nullable|string|max:255',
        ]);

        // dd($validated);

        // استرجاع القالب للمستخدم الحالي
        $userId = Auth::id();
        $template = Template::where('user_id', $userId)->first(); // أو استخدم where('user_id', Auth::id())

        // إذا كان القالب موجودًا، نقوم بتحديثه، إذا لم يكن، ننشئه
        if ($template) {
            $template->update([
                'name' => $validated['name'],
                'url' => $validated['url'],
                'password' => $validated['password'] ?? $template->password, // إذا لم يضع كلمة مرور جديدة، نترك السابقة
            ]);
            // dd("done");
        } else {
            Template::create([
                'user_id' => $userId,
                'name' => $validated['name'],
                'url' => $validated['url'],
                'password' => $validated['password'] ?? null,
            ]);
        }

        // dd("done");
        // إرجاع استجابة مع رسالة تأكيد
        return redirect()->route('user.settings')->with('success', 'تم تحديث الإعدادات بنجاح');
    }


    // عرض القالب بناءً على الرابط
    public function show($url)
    {
        // استرجاع القالب باستخدام الرابط
        $template = Template::where('url', $url)->first();

        if ($template) {
            return view('user.pages.cvDesign', compact('template'));
        } else {
            abort(404); // إذا لم يتم العثور على القالب
        }
    }


    // عرض السيرة الذاتية
    public function viewCV($url)
    {
        // البحث عن السيرة الذاتية بناءً على الرابط
        $template = Template::where('url', $url)->first();

        if (!$template) {
            return redirect()->route('home')->with('error', 'السيرة الذاتية غير موجودة');
        }

        // إذا كانت السيرة تحتوي على كلمة مرور، نعرض صفحة إدخال كلمة المرور
        if ($template->password) {
            return view('user.pages.cvPassword', compact('template'));
        }

        // إذا لم تكن هناك كلمة مرور، نوجه المستخدم مباشرة إلى السيرة الذاتية
        return redirect($template->template_name);
    }

    // التحقق من كلمة المرور
    public function verifyPassword($url, Request $request)
    {
        // البحث عن السيرة الذاتية بناءً على الرابط
        $template = Template::where('url', $url)->first();

        if (!$template) {
            return redirect($template->template_name);
        }

        // التحقق من كلمة المرور
        if ($template->password) {
            if ($template->password === $request->password) {
                // إذا كانت كلمة المرور صحيحة، نعرض السيرة الذاتية
                return redirect($template->template_name);
            } else {
                // إذا كانت كلمة المرور خاطئة، نعرض رسالة خطأ
                return redirect()->route('user.view', ['url' => $template->url])->with('error', 'كلمة المرور غير صحيحة');
            }
        }

        // إذا لم تكن هناك كلمة مرور، نوجه المستخدم مباشرة إلى السيرة الذاتية
        return redirect($template->template_name);
    }


    

}
