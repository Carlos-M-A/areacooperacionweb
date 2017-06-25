<?php

 /*
    |--------------------------------------------------------------------------
    | General constans for the app
    |--------------------------------------------------------------------------
    |
    | 
    */

return [

    'pagination' => 7, // Items requested on each query
    'max_width_height_images' => 512, // In pixels. To avatars images
    'max_size_of_images' => 100, // In KB
    'max_size_of_curriculums' => 200,// In KB
 
    'link_in_app_name' => env('APP_NAME_LINK', 'http://localhost'), // Link when click in app name in header of web
];
