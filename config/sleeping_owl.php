<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Title
    |--------------------------------------------------------------------------
    |
    | Displayed in title and header.
    |
    */

    'title' => 'Sinestetika Admin Panel',

    /*
    |--------------------------------------------------------------------------
    | Admin Logo
    |--------------------------------------------------------------------------
    |
    | Displayed in navigation panel.
    |
    */

    'logo' => '<svg style="padding:10px;" class="pull-left" width="48px" height="48px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 372.3 372.3" enable-background="new 0 0 372.3 372.3" xml:space="preserve"><path fill="#fff" d="M186.6,164.9c-60.2,0-75.1-8.9-75.1-20.7c0-11.8,12.4-21.2,77.1-21.2c75.1,0,160.1,11.9,160.1,11.9l0-81.3
	c0,0-60.5-10.2-160-10.2S0,62.2,0,133.7c0,75.2,123.9,75.4,199.8,75.7c46.7,0.2,60.1,6.6,60.1,19.7c0,14.8-22.9,21.3-66.7,21.3
	C74,250.4,2.9,231.8,2.9,231.8v80.6c0,0,73.5,16.7,165.8,16.7s203.6-3.8,203.6-87.3C372.3,162.8,246.8,164.9,186.6,164.9z"/></svg> <span class="pull-left">Admin Panel</span>',
    'logo_mini' => '<svg style="padding:10px;" class="pull-left" width="48px" height="48px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 372.3 372.3" enable-background="new 0 0 372.3 372.3" xml:space="preserve"><path fill="#fff" d="M186.6,164.9c-60.2,0-75.1-8.9-75.1-20.7c0-11.8,12.4-21.2,77.1-21.2c75.1,0,160.1,11.9,160.1,11.9l0-81.3
	c0,0-60.5-10.2-160-10.2S0,62.2,0,133.7c0,75.2,123.9,75.4,199.8,75.7c46.7,0.2,60.1,6.6,60.1,19.7c0,14.8-22.9,21.3-66.7,21.3
	C74,250.4,2.9,231.8,2.9,231.8v80.6c0,0,73.5,16.7,165.8,16.7s203.6-3.8,203.6-87.3C372.3,162.8,246.8,164.9,186.6,164.9z"/></svg>',

    /*
    |--------------------------------------------------------------------------
    | Admin URL prefix
    |--------------------------------------------------------------------------
    */

    'url_prefix' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Middleware to use in admin routes
    |--------------------------------------------------------------------------
    |
    | In order to create authentication views and routes
    | don't forget to execute `php artisan make:auth`.
    | See https://laravel.com/docs/5.2/authentication#authentication-quickstart
    |
    | Note: Please remove 'web' middleware for Laravel 5.1 or older
    |
    */

    'middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Authentication default provider
    |--------------------------------------------------------------------------
    |
    | @see config/auth.php : providers
    |
    */

    'auth_provider' => 'users',

    /*
    |--------------------------------------------------------------------------
    |  Path to admin bootstrap files directory
    |--------------------------------------------------------------------------
    |
    | Default: app_path('Admin')
    |
    */

    'bootstrapDirectory' => app_path('Admin'),

    /*
    |--------------------------------------------------------------------------
    |  Directory for uploaded images (relative to `public` directory)
    |--------------------------------------------------------------------------
    */

    'imagesUploadDirectory' => 'images/uploads',

    /*
    |--------------------------------------------------------------------------
    |  Directory for uploaded files (relative to `public` directory)
    |--------------------------------------------------------------------------
    */

    'filesUploadDirectory' => 'files/uploads',

    /*
    |--------------------------------------------------------------------------
    |  Admin panel template
    |--------------------------------------------------------------------------
    */

    'template' => SleepingOwl\Admin\Templates\TemplateDefault::class,

    /*
    |--------------------------------------------------------------------------
    |  Default date and time formats
    |--------------------------------------------------------------------------
    */

    'datetimeFormat' => 'd.m.Y H:i',
    'dateFormat' => 'd.m.Y',
    'timeFormat' => 'H:i',

    /*
    |--------------------------------------------------------------------------
    | Editors
    |--------------------------------------------------------------------------
    |
    | Select default editor and tweak options if needed.
    |
    */

    'wysiwyg' => [
        'default' => 'ckeditor',

        /*
         * See http://docs.ckeditor.com/#!/api/CKEDITOR.config
         */
        'ckeditor' => [
            'height' => 200,
        ],

        /*
         * See https://www.tinymce.com/docs/
         */
        'tinymce' => [
            'height' => 200,
        ],

        /*
         * See https://github.com/NextStepWebs/simplemde-markdown-editor
         */
        'simplemde' => [
            'hideIcons' => ['side-by-side', 'fullscreen'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | DataTables
    |--------------------------------------------------------------------------
    |
    | Select default settings for datatable
    |
    */
    'datatables' => [],

    /*
    |--------------------------------------------------------------------------
    | Breadcrumbs
    |--------------------------------------------------------------------------
    |
    */
    'breadcrumbs' => true,

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started.
    |
    */

    'aliases' => [
        // Components
        'Assets' => KodiCMS\Assets\Facades\Assets::class,
        'PackageManager' => KodiCMS\Assets\Facades\PackageManager::class,
        'Meta' => KodiCMS\Assets\Facades\Meta::class, // todo избавиться
        'Form' => Collective\Html\FormFacade::class,
        'HTML' => Collective\Html\HtmlFacade::class,
        'WysiwygManager' => SleepingOwl\Admin\Facades\WysiwygManager::class,
        'MessagesStack' => SleepingOwl\Admin\Facades\MessageStack::class,

        // Presenters
        'AdminSection' => SleepingOwl\Admin\Facades\Admin::class,
        'AdminTemplate' => SleepingOwl\Admin\Facades\Template::class,
        'AdminNavigation' => SleepingOwl\Admin\Facades\Navigation::class,
        'AdminColumn' => SleepingOwl\Admin\Facades\TableColumn::class,
        'AdminColumnEditable' => SleepingOwl\Admin\Facades\TableColumnEditable::class,
        'AdminColumnFilter' => SleepingOwl\Admin\Facades\TableColumnFilter::class,
        'AdminDisplayFilter' => SleepingOwl\Admin\Facades\DisplayFilter::class,
        'AdminForm' => SleepingOwl\Admin\Facades\Form::class,
        'AdminFormElement' => SleepingOwl\Admin\Facades\FormElement::class,
        'AdminDisplay' => SleepingOwl\Admin\Facades\Display::class,
        'AdminWidgets' => SleepingOwl\Admin\Facades\Widgets::class,
    ],
];
