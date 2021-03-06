<?php

namespace mrstroz\wavecms\form\controllers;

use mrstroz\wavecms\components\grid\ActionColumn;
use mrstroz\wavecms\components\grid\CheckboxColumn;
use mrstroz\wavecms\components\web\Controller;
use mrstroz\wavecms\form\models\Form;
use mrstroz\wavecms\form\models\search\FormSearch;
use Yii;
use yii\data\ActiveDataProvider;

class ContactController extends Controller
{

    public function init()
    {
        /** @var Form $model */
        $model = Yii::createObject(Form::class);

        $this->heading = Yii::t('wavecms_form/main', 'Contact form');
        $this->query = $model::find()->andWhere(['type' => 'contact']);

        $this->dataProvider = new ActiveDataProvider([
            'query' => $this->query
        ]);

        $this->dataProvider->sort->defaultOrder = ['created_at' => SORT_DESC];

        $this->filterModel = Yii::createObject(FormSearch::class);

        $this->columns = array(
            [
                'class' => CheckboxColumn::class,

            ],
            'created_at:datetime',
            'name',
            'email',
            [
                'class' => ActionColumn::class,
            ],
        );


        parent::init();
    }


}