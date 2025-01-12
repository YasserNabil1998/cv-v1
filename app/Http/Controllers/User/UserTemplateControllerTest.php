<?php

namespace Tests\Unit;

use App\Http\Controllers\User\UserTemplateController;
use App\Models\UserTemplateSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class UserTemplateControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_save_settings_success()
    {
        // إنشاء نسخة من الـ controller
        $controller = new UserTemplateController();

        // إنشاء طلب POST مع القيم المطلوبة
        $request = Request::create('/save-settings', 'POST', [
            'template_name' => 'Test Template',
            'font_family' => 'Arial',
            'font_color' => '#000000',
            'heading_color' => '#FFFFFF',
            'background_color' => '#FF5733', // تغيير لون الخلفية للقيمة الجديدة
        ]);

        // استدعاء الدالة التي تحفظ الإعدادات
        $response = $controller->saveSettings($request);

        // تحقق من أن البيانات تم حفظها في قاعدة البيانات بشكل صحيح
        $this->assertDatabaseHas('user_template_settings', [
            'template_name' => 'Test Template',
            'font_family' => 'Arial',
            'font_color' => '#000000',
            'heading_color' => '#FFFFFF',
            'background_color' => '#FF5733', // التحقق من القيمة الصحيحة للـ background_color
        ]);

        // تحقق من أن الاستجابة كانت ناجحة (200)
        $this->assertEquals(200, $response->getStatusCode());

        // تحقق من أن الاستجابة تحتوي على الرسالة الصحيحة
        $response->assertJson(['message' => 'Settings saved successfully!']);
    }
}
