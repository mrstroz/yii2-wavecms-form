<?php

namespace mrstroz\wavecms\form\controllers;

use mrstroz\wavecms\components\grid\ActionColumn;
use mrstroz\wavecms\components\web\Controller;
use mrstroz\wavecms\form\models\Form;
use Yii;
use yii\data\ActiveDataProvider;

class ContactController extends Controller
{

    public function init()
    {
        if (isset($this->module->forms['form/contact'])) {
            $this->viewForm = $this->module->forms['form/contact'];
        }

        /** @var Form $model */
        $model = Yii::createObject($this->module->models['Contact']);

        $this->heading = Yii::t('wavecms/form/main', 'Contact form');
        $this->query = $model::find()->andWhere(['type' => 'contact']);

        $this->dataProvider = new ActiveDataProvider([
            'query' => $this->query
        ]);

        $this->dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];

        $this->columns = array(
            'created_at:datetime',
            'name',
            'email',
            [
                'class' => ActionColumn::className(),
            ],
        );


        parent::init();
    }


}