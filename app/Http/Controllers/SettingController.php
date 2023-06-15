<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    const DIRECTORY = 'dashboard.settings';

    function __construct()
    {
        $this->middleware('check_permission:edit_settings')->only(['update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function basic($view)
    {
        $setting = Setting::findOrFail(1);
        return view(self::DIRECTORY . "." . $view, \get_defined_vars())->with('directory', self::DIRECTORY);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingRequest  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $data = $request->validated();
        $setting->update($data);
        foreach (Setting::UPLOADFIELDS as $field) {
            if ($request->hasFile($field)) $setting->addMediaFromRequest($field)->toMediaCollection($field);
        }
        return response()->json(['success' => __('messages.updated')]);
    }
}
