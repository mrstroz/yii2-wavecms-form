<?php

namespace mrstroz\wavecms\form;

use mrstroz\wavecms\components\helpers\FontAwesome;
use Yii;
use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app->id === 'app-backend') {
            Yii::setAlias('@wavecms_form', '@vendor/mrstroz/yii2-wavecms-form');

            Yii::$app->i18n->translations['wavecms/form/*'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@wavecms_form/messages',
                'fileMap' => [
                    'wavecms/form/main' => 'main.php',
                ],
            ];

            Yii::$app->params['nav'][] = [
                'label' => FontAwesome::icon('paper-plane-o') . Yii::t('wavecms/form/main', 'Forms'),
                'url' => 'javascript: ;',
                'options' => [
                    'class' => 'drop-down'
                ],
                'permission' => 'page',
                'position' => 5000,
                'items' => [
                    [
                        'label' => FontAwesome::icon('ellipsis-h') . Yii::t('wavecms/form/main', 'Contact form'),
                        'url' => ['/form/contact/index'],
                        'items' => [

                        ]
                    ],
                    [
                        'label' => FontAwesome::icon('ellipsis-h') . Yii::t('wavecms/form/main', 'Contact form - Settings'),
                        'url' => ['/form/contact-settings/page']
                    ]

                ]
            ];


        }
    }
}