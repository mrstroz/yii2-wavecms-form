<?php

namespace mrstroz\wavecms\form;

/**
 * Class Module
 * @package mrstroz\wavecms\form
 * This is the main module class of the yii2-wavecms-form.
 */

class Module extends \yii\base\Module
{
    /**
     * @var array Class mapping
     */
    public $classMap = [];

    public function init()
    {
        $this->controllerNamespace = 'mrstroz\wavecms\form\controllers';

        parent::init();
    }

}
