<?php

namespace mrstroz\wavecms\form\models\query;

use mrstroz\wavecms\form\models\FormSettings;

/**
 * This is the ActiveQuery class for [[FormSettings]].
 *
 * @see FormSettings
 */
class FormSettingsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return FormSettings[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FormSettings|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function getSettings($type)
    {
        return $this
            ->joinWith('translations')
            ->andFilterWhere(['and',
                ['=', 'type', $type],
            ]);
    }
}
