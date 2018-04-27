<?php

namespace mrstroz\wavecms\form;

use mrstroz\wavecms\components\helpers\FontAwesome;
use mrstroz\wavecms\form\models\Form;
use mrstroz\wavecms\form\models\FormQuery;
use mrstroz\wavecms\form\models\FormSearch;
use mrstroz\wavecms\form\models\FormSettings;
use mrstroz\wavecms\form\models\FormSettingsLang;
use mrstroz\wavecms\form\models\FormSettingsLangQuery;
use mrstroz\wavecms\form\models\FormSettingsQuery;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Exception;
use yii\i18n\PhpMessageSource;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {

        Yii::setAlias('@wavecms_form', '@vendor/mrstroz/yii2-wavecms-form');

        /** Set backend language based on user lang (Must be done before define translations */
        if ($app->id === 'app-backend') {
            if (!Yii::$app->user->isGuest) {
                Yii::$app->language = Yii::$app->user->identity->lang;
            }
        }

        $this->initTranslations();

        /** @var Module $module */
        if ($app->hasModule('wavecms') && ($module = $app->getModule('wavecms-form')) instanceof Module) {

            if ($app->id === 'app-backend') {

                $this->initNavigation();
                $this->initContainer($module);
            }
        }


    }

    /**
     * Init translations
     */
    protected function initTranslations()
    {
        Yii::$app->i18n->translations['wavecms_form/*'] = [
            'class' => PhpMessageSource::class,
            'basePath' => '@wavecms_form/messages',
            'fileMap' => [
                'main' => 'main.php',
            ],
        ];
    }

    /**
     * Init class map and dependency injection container
     * @param Module $module
     * @return void
     * @throws Exception
     */
    protected function initContainer($module)
    {
        $map = [];

        $defaultClassMap = [

            /* MODELS */
            'Form' => Form::class,
            'FormSettings' => FormSettings::class,
            'FormSettingsLang' => FormSettingsLang::class,

            /* QUERIES */
            'FormQuery' => FormQuery::class,
            'FormSettingsQuery' => FormSettingsQuery::class,
            'FormSettingsLangQuery' => FormSettingsLangQuery::class,

            /* SEARCH */
            'FormSearch' => FormSearch::class
        ];

        $routes = [
            'mrstroz\\wavecms\\form\\models' => [
                'Form',
                'FormSettings',
                'FormSettingsLang',
            ],
            'mrstroz\\wavecms\\models\\form\\query' => [
                'FormQuery',
                'FormSettingsQuery',
                'FormSettingsLangQuery',
            ],
            'mrstroz\\wavecms\\models\\form\\search' => [
                'FormSearch'
            ]
        ];
        $mapping = array_merge($defaultClassMap, $module->classMap);

        foreach ($mapping as $name => $definition) {
            $map[$this->getContainerRoute($routes, $name) . "\\$name"] = $definition;
        }

        $di = Yii::$container;

        foreach ($map as $class => $definition) {
            /** Check if definition does not exist in container. */
            if (!$di->has($class)) {
                $di->set($class, $definition);
            }
        }

    }


    /**
     * Init left navigation
     */
    protected function initNavigation()
    {
        Yii::$app->params['nav']['wavecms_form'] = [
            'label' => FontAwesome::icon('paper-plane') . Yii::t('wavecms_form/main', 'Forms'),
            'url' => 'javascript: ;',
            'options' => [
                'class' => 'drop-down'
            ],
            'permission' => 'page',
            'position' => 5000,
            'items' => [
                [
                    'label' => FontAwesome::icon('ellipsis-h') . Yii::t('wavecms_form/main', 'Contact form'),
                    'url' => ['/wavecms-form/contact/index'],
                    'items' => [

                    ]
                ],
                [
                    'label' => FontAwesome::icon('ellipsis-h') . Yii::t('wavecms_form/main', 'Contact form - Settings'),
                    'url' => ['/wavecms-form/contact-settings/page']
                ]

            ]
        ];
    }

    /**
     * Get container route for class name
     * @param array $routes
     * @param $name
     * @throws \yii\base\Exception
     * @return int|string
     */
    private function getContainerRoute(array $routes, $name)
    {
        foreach ($routes as $route => $names) {
            if (in_array($name, $names, false)) {
                return $route;
            }
        }
        throw new Exception("Unknown configuration class name '{$name}'");
    }

}