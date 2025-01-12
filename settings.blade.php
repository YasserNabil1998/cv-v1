@extends('user.layouts.master')

@section('title', 'Dashboard User')

@section('main-content')

    <!-- تحميل Bootstrap من CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- تنسيق مخصص للأزرار -->
    <style>
        .active {
            color: #717ff5 !important;
        }

        .section-wrapper {
            margin: 1rem auto;
            padding: 1rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background: #f8f9fa;
        }

        #main {
            margin-top: 0px;
            padding: 20px 30px;
            transition: all 0.3s;
        }
    </style>

    <!-- شريط التنقل -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light bg-secondary " style="margin-top: 60px">
        <div class="d-flex p-0 m-0">
            <a href="{{ route('user.newCvs') }}" class="navbar-brand text-dark d-flex align-items-center px-3 py-2 m-0">
                <i class="bi bi-person m-1 text-dark"></i>
                <span class="d-none d-md-inline-block">بيانات السيرة</span>
            </a>
            <a href="{{ route('user.cvDesign') }}" class="navbar-brand text-dark d-flex align-items-center px-3 py-2 m-0">
                <i class="bi bi-pencil m-1 text-dark"></i>
                <span class="d-none d-md-inline-block">التصميم</span>
            </a>
            <a href="{{ route('user.cvDownload-share') }}"
                class="navbar-brand text-dark d-flex align-items-center px-3 py-2 m-0">
                <i class="bi bi-cloud-arrow-down m-1 text-dark"></i>
                <span class="d-none d-md-inline-block">تحميل ومشاركة</span>
            </a>
            <a href="{{ route('user.settings') }}"
                class="navbar-brand text-dark d-flex align-items-center px-3 py-2 m-0 active">
                <i class="bi bi-gear m-1 text-dark"></i>
                <span class="d-none d-md-inline-block">تخصيص</span>
            </a>
        </div>
    </nav>

    <div class="container py-3">

        <form action="{{ route('user.settings.update') }}" method="POST">
            @csrf
            <div class="bg-light p-3 rounded mb-3 border">
                <div class="mb-2 row">
                    <label for="settings.name" class="col-sm-2 col-form-label text-sm font-weight-bold text-gray-500">اسم
                        السيرة</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="settings.name" name="name"
                            placeholder="سيرة مختصرة، مثال: مهندس معماري" autocomplete="off" dir="rtl">
                    </div>
                </div>
            </div>

            <div class="bg-light p-3 rounded mb-3 border">
                <div class="mb- row">
                    <label for="settings.url" class="col-sm-2 col-form-label text-sm font-weight-bold text-gray-500">رابط
                        السيرة</label>
                    <div class="col-sm-6">
                        <div class="input-group">
                            <input type="text" class="form-control border-start-0" id="settings.url" name="url"
                                placeholder="my-awesome-cv" autocomplete="off" dir="ltr">
                            <span class="input-group-text bg-light text-gray-500 border-end-0">https://seirah.com/</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-light p-3 rounded mb-3 border">
                <div class="mb-3 row">
                    <label for="settings.password"
                        class="col-sm-2 col-form-label text-sm font-weight-bold text-gray-500">كلمة مرور لعرض السيرة</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" id="settings.password" name="password"
                            placeholder="Secret" autocomplete="off" dir="rtl">
                        <small class="form-text text-muted mt-2">
                            إتركها فارغة للسماح لأي شخص يحصل على رابط السيرة بمعاينتها، أو ضع كلمة مرور لحمايتها من الظهور
                            للآخرين.
                        </small>
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-gradient">
                    <i class="ti-save me-2"></i> حفظ الإعدادات
                </button>
            </div>
        </form>

        <!-- رابط السيرة الذاتية -->
        <div class="input-group my-3">
            <!-- حقل النص لعرض الرابط -->
            <input type="text" id="cv-link" value="{{ route('user.view', ['url' => $template->url]) }}" readonly
                class="form-control" aria-label="CV Link">
            <!-- زر نسخ الرابط -->
            <button onclick="copyLink()" class="btn btn-primary" type="button">
                نسخ الرابط
            </button>
        </div>

        <!-- النافذة المنبثقة -->
        <div id="copy-toast" class="toast align-items-center text-bg-success border-0 position-fixed bottom-0 end-0 p-2 m-3"
            role="alert" aria-live="assertive" aria-atomic="true" style="display: none;">
            <div class="d-flex">
                <div class="toast-body">
                    تم نسخ الرابط بنجاح!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" onclick="hideToast()"
                    aria-label="Close"></button>
            </div>
        </div>

        <style>
            #copy-toast {
                z-index: 1055;
                /* للتأكد من ظهور النافذة فوق العناصر الأخرى */
                border-radius: 5px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            }
        </style>
        <script>
            function copyLink() {
                const link = document.getElementById('cv-link');
                link.select();
                link.setSelectionRange(0, 99999); // لأجهزة الموبايل
                document.execCommand('copy');

                // عرض النافذة المنبثقة
                const toast = document.getElementById('copy-toast');
                toast.style.display = 'block';
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 3000); // تختفي النافذة بعد 3 ثوانٍ
            }

            function hideToast() {
                const toast = document.getElementById('copy-toast');
                toast.style.display = 'none';
            }
        </script>

    </div>

@endsection
