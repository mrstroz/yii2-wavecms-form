<?php

namespace mrstroz\wavecms\form\models;

use Yii;
use yii\data\ActiveDataProvider;

class FormSearch extends Form
{

    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'safe'],
        ];
    }

    /**
     * @param $dataProvider ActiveDataProvider
     * @return mixed
     */
    public function search($dataProvider)
    {
        $params = Yii::$app->request->get();

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $dataProvider->query->andFilterWhere(['or',
            ['like', 'name', $this->name],
            ['like', 'email', $this->email]
        ]);

        return $dataProvider;
    }


}
