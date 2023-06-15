<?php

use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

/**
 * Check Permissions of Admin Guard User
 */
function permission($permission)
{
    return (Auth::guard('admin')->user()?->type == 'super_admin' || Auth::guard('admin')->user()?->hasAnyPermission($permission))  ? true : false;
}

/**
 * permission description indicator
 */
function permission_description($permission)
{
    if ($permission != null) {
        echo "<span class='text-danger font-size-12'>(";
        echo __("lang.$permission->name" . '_desc');
        echo ")</span>";
    }
}

/**
 * permission description indicator
 */
function lang($lang)
{
    if ($lang != null) {
        echo "<span class='text-danger font-size-11'>(";
        echo __("langapp()->getLocale()");
        echo ")</span>";
    }
}
