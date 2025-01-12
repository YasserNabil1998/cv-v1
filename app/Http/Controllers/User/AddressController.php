<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // التحقق من المدخلات
        $request->validate([
            'national_address_ar' => 'required|string',
            'national_address_en' => 'required|string',
        ]);

        // dd($request->all());
        Address::create([
            'user_id' => Auth::id(),
            'national_address_ar' => $request->national_address_ar,
            'national_address_en' => $request->national_address_en,
        ]);

        // dd("done");

        return redirect()->back()->with('success', 'تم حفظ العنوان الوطني بنجاح!');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
