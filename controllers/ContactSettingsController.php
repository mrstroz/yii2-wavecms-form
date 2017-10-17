<?php

namespace mrstroz\wavecms\form\controllers;

use mrstroz\wavecms\components\web\Controller;
use mrstroz\wavecms\page\models\Page;
use Yii;

class ContactSettingsController extends Controller
{

    public function init()
    {
        $this->type = 'page';

        /** @var Page $modelPage */
        $modelPage = Yii::createObject($this->module->models['ContactSettings']);

        $this->heading = Yii::t('wavecms/form/main', 'Contact form - Settings');
        $this->query = $modelPage::find()->andWhere(['type' => 'contact']);

        parent::init();
    }


}