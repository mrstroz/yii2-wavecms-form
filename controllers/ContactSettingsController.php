<?php

namespace mrstroz\wavecms\form\controllers;

use mrstroz\wavecms\components\web\Controller;
use mrstroz\wavecms\form\models\FormSettings;
use mrstroz\wavecms\page\models\Page;
use Yii;

class ContactSettingsController extends Controller
{

    public function init()
    {
        $this->type = 'page';

        /** @var Page $modelPage */
        $modelPage = Yii::createObject(FormSettings::className());

        $this->heading = Yii::t('wavecms_form/main', 'Contact form - Settings');
        $this->query = $modelPage::find()->andWhere(['type' => 'contact']);

        parent::init();
    }


}