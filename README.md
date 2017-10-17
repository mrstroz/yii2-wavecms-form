# yii2-wavecms-form
**Form module for [Yii 2 WaveCMS](https://github.com/mrstroz/yii2-wavecms).** 

Please do all install steps first from [Yii 2 WaveCMS](https://github.com/mrstroz/yii2-wavecms).

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Run

```
composer require --prefer-source "mrstroz/yii2-wavecms-form" "dev-master"
```

or add

```
"mrstroz/yii2-wavecms-form": "dev-master"
```

to the require section of your `composer.json` file.


Required
--------

1. Update `backend/config/main.php` (Yii2 advanced template) 
```php
'bootstrap' => [
    // ...
    'mrstroz\wavecms\form\Bootstrap'
],
'modules' => [
    // ...
    'page' => [
        'class' => 'mrstroz\wavecms\form\Module',
        /*
         * Overwrite model classes and form views
         'models' => [
            'Contact' => 'mrstroz\wavecms\form\models\Form',
            'ContactSettings' => 'mrstroz\wavecms\form\models\FormSettings'
         ],
         'forms' => [
            'form/contact' => '@backend/views/form/contact/form.php'
            'form/contact-settings' => '@backend/views/form/contact/form.php'
         ]
         */
    ],
],

```

Form views can be overwritten by backend [themes](http://www.yiiframework.com/doc-2.0/guide-output-theming.html);

2. Run migration 
```
yii migrate/up --migrationPath=@vendor/mrstroz/yii2-wavecms-form/migrations
```

Usage in frontend
-----------------






