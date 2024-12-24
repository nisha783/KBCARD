<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //

       // If your settings table is not following default conventions
       protected $table = 'settings';

       // Define fillable or guarded properties as per your requirements
       protected $fillable = ['key', 'value'];
   
       // You can use this method to fetch the value for a specific key dynamically.
       public static function getSettingValueByKey($key)
       {
           $setting = self::where('key', $key)->first();
           return $setting ? $setting->value : null;  // Return value or null if not found
       }
}
