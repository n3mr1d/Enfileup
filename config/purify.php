<?php

use Stevebauman\Purify\Definitions\Html5Definition;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Config
    |--------------------------------------------------------------------------
    */

    'default' => 'secure',

    /*
    |--------------------------------------------------------------------------
    | Config sets
    |--------------------------------------------------------------------------
    | 
    | Ditingkatkan keamanannya:
    | - Hanya mengizinkan elemen HTML dan atribut penting (script, style, object, iframe, embed, on* Event *TIDAK* diizinkan).
    | - Atribut src hanya untuk img, dengan filter protocol (tidak boleh javascript:).
    | - Tag <style>, <iframe>, <object>, <embed>, dan semua handler JS di-blacklist.
    | - Agar inline style pada tag p/element pun TIDAK diizinkan, tidak ada CSS selain yang sangat aman.
    |
    */

    'configs' => [

        'secure' => [
            'Core.Encoding' => 'utf-8',
            'HTML.Doctype' => 'HTML 4.01 Transitional',

            // Izinkan tag + atribut "style" untuk elemen tertentu
            'HTML.Allowed' => 'h1[style],h2[style],h3[style],h4[style],h5[style],h6[style],
        b[style],u[style],strong[style],i[style],em[style],s[style],del[style],
        a[href|title|target|style],
        ul[style],ol[style],li[style],p[style],br,span[style],
        img[src|width|height|alt|style],
        blockquote[style],pre[style],code[style],
        table[style],thead[style],tbody[style],tr[style],th[style],td[style],
        hr[style],div[style]',

            'HTML.ForbiddenElements' => 'script,iframe,object,embed',
            'Attr.EnableID' => false,
            'Attr.AllowedFrameTargets' => ['_blank', '_self', '_parent', '_top'],
            'URI.SafeIframeRegexp' => null,

            // Izinkan properti CSS tertentu
            'CSS.AllowedProperties' => [
                'color',
                'background-color',
                'font',
                'font-size',
                'font-weight',
                'font-style',
                'text-decoration',
                'text-align',
                'margin',
                'padding',
                'border',

                'width',
                'height',

                'float',
            ],

            'URI.AllowedSchemes' => [
                'http' => true,
                'https' => true,
                'mailto' => true,
            ],

            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.RemoveEmpty' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | HTMLPurifier definitions
    |--------------------------------------------------------------------------
    */
    'definitions' => Html5Definition::class,

    /*
    |--------------------------------------------------------------------------
    | HTMLPurifier CSS definitions
    |--------------------------------------------------------------------------
    */
    'css-definitions' => null,

    /*
    |--------------------------------------------------------------------------
    | Serializer
    |--------------------------------------------------------------------------
    |
    | The storage implementation where HTMLPurifier can store its serializer files.
    | If the filesystem cache is in use, the path must be writable through the
    | storage disk by the web server, otherwise an exception will be thrown.
    |
    */
    'serializer' => [
        'driver' => env('CACHE_STORE', env('CACHE_DRIVER', 'file')),
        'cache' => \Stevebauman\Purify\Cache\CacheDefinitionCache::class,
    ],

    // 'serializer' => [
    //    'disk' => env('FILESYSTEM_DISK', 'local'),
    //    'path' => 'purify',
    //    'cache' => \Stevebauman\Purify\Cache\FilesystemDefinitionCache::class,
    // ],

];
