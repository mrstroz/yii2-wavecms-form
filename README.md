# yii2-wavecms-form
**Form module for [Yii 2 WaveCMS](https://github.com/mrstroz/yii2-wavecms).** 

Please do all install steps first from [Yii 2 WaveCMS](https://github.com/mrstroz/yii2-wavecms).

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Run

```
composer require --prefer-source "mrstroz/yii2-wavecms-form" "~0.1.0"
```

or add

```
"mrstroz/yii2-wavecms-form": "~0.1.0"
```

to the require section of your `composer.json` file.


Required
--------

1. Update `backend/config/main.php` (Yii2 advanced template) 
```php
'modules' => [
    // ...
    'wavecms-form' => [
        'class' => 'mrstroz\wavecms\form\Module',
        /*
        * Override classes
        'classMap' => [
            'Form' => 'common\models\Form',
        ]
        */
    ],
],

```

Form views can be overwritten by backend [themes](http://www.yiiframework.com/doc-2.0/guide-output-theming.html);

2. Add the `migrationPath` in `console/config/main.php` and run `yii migrate`:

```php
// Add migrationPaths to console config:
'controllerMap' => [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => [
            '@vendor/mrstroz/yii2-wavecms-form/migrations'
        ],
    ],
],
```

Or run migrates directly

```yii
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
            $formSettings->replaceExtraTag('tag', 'value');

            if ($formSettings->send_email) {
                Yii::$app->mailer->compose()
                    ->setSubject($formSettings->subject)
                    ->setFrom([$formSettings->from_email => $formSettings->from_name])
                    ->setHtmlBody($formSettings->text)
                    ->setTo(explode(',', $formSettings->recipient))
                    ->send();
            }
            
            if ($formSettings->user_send_email) {
                Yii::$app->mailer->compose()
                    ->setSubject($formSettings->user_subject)
                    ->setFrom([$formSettings->user_from_email => $formSettings->user_from_name])
                    ->setHtmlBody($formSettings->user_text)
                    ->setTo($model->email)
                    ->send();
            }
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




