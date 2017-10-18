<?php

namespace mrstroz\wavecms\form\models;

/**
 * This is the ActiveQuery class for [[FormSettingsLang]].
 *
 * @see FormSettingsLang
 */
class FormSettingsLangQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return FormSettingsLang[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return FormSettingsLang|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
