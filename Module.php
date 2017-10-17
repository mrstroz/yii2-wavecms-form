<?php

namespace mrstroz\wavecms\form;

class Module extends \yii\base\Module
{
    public $models = [];
    public $forms = [];

    public function init()
    {
        if (!isset($this->models['Contact'])) {
            $this->models['Contact'] = 'mrstroz\wavecms\form\models\Form';
        }

        if (!isset($this->models['ContactSettings'])) {
            $this->models['ContactSettings'] = 'mrstroz\wavecms\form\models\FormSettings';
        }

        $this->controllerNamespace = 'mrstroz\wavecms\form\controllers';

        parent::init();
    }

}
