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
    'form' => [
        'class' => 'mrstroz\wavecms\form\Module',
        /*
         * Overwrite model classes and form views
         'models' => [
            'Contact' => 'mrstroz\wavecms\form\models\Form',
            'ContactSettings' => 'mrstroz\wavecms\form\models\FormSettings'
         ],
         'forms' => [
            'form/contact' => '@backend/views/form/contact/form.php'
            'form/contact-settings' => '@backend/views/form/contact-settings/form.php'
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

1. **Controller**
```php
<?php
// ...
use mrstroz\wavecms\form\models\Form;
use mrstroz\wavecms\form\models\FormSettings;
// ...

public function actionIndex()
    {
        $model = new Form();
        $formSettings = false;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();

            $formSettings = FormSettings::find()->getSettings('contact')->one();
            $formSettings->replaceTags($model);

            Yii::$app->mailer->compose()
                ->setSubject($formSettings->subject)
                ->setFrom([$formSettings->from_email => $formSettings->from_name])
                ->setHtmlBody($formSettings->text)
                ->setTo(explode(',', $formSettings->recipient))
                ->send();
        }

        return $this->render('index', [
            'model' => $model,
            'formSettings' => $formSettings
        ]);
    }
```

2. **View**
```php
<?php
// ...
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
// ...
Pjax::begin();
/** @var \mrstroz\wavecms\form\models\FormSettings $formSettings */
if ($formSettings) {
    echo $formSettings->thanks_text;
} else {
    $form = ActiveForm::begin(['options' => ['data-pjax' => true]]);

    echo Html::activeHiddenInput($model, 'language', ['value' => Yii::$app->language]);
    echo Html::activeHiddenInput($model, 'type', ['value' => 'contact']);

    echo $form->field($model, 'name');
    echo $form->field($model, 'company');
    echo $form->field($model, 'email');
    echo $form->field($model, 'phone');
    echo $form->field($model, 'subject');
    echo $form->field($model, 'text')->textarea();

    echo Html::submitButton();

    ActiveForm::end();
}
Pjax::end();
// ...

```




