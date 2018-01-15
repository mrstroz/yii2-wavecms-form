<?php

namespace mrstroz\wavecms\form\models;

use mrstroz\wavecms\form\models\query\FormSettingsLangQuery;
use Yii;

/**
 * This is the model class for table "form_settings_lang".
 *
 * @property integer $id
 * @property integer $form_settings_id
 * @property string $language
 * @property integer $send_email
 * @property string $from_name
 * @property string $from_email
 * @property string $recipient
 * @property string $subject
 * @property string $text
 * @property string $thanks_text
 */
class FormSettingsLang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'form_settings_lang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['send_email'], 'integer'],
            [['form_settings_id'], 'safe'],
            [['text', 'thanks_text'], 'string'],
            [['language'], 'string', 'max' => 50],
            [['from_name', 'from_email', 'recipient', 'subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms_form/main', 'ID'),
            'form_settings_id' => Yii::t('wavecms_form/main', 'Form Settings ID'),
            'language' => Yii::t('wavecms_form/main', 'Language'),
            'send_email' => Yii::t('wavecms_form/main', 'Send email'),
            'from_name' => Yii::t('wavecms_form/main', 'From name'),
            'from_email' => Yii::t('wavecms_form/main', 'From email'),
            'recipient' => Yii::t('wavecms_form/main', 'Recipient'),
            'subject' => Yii::t('wavecms_form/main', 'Subject'),
            'text' => Yii::t('wavecms_form/main', 'Text'),
            'thanks_text' => Yii::t('wavecms_form/main', 'Thanks text'),
        ];
    }

    /**
     * @inheritdoc
     * @return FormSettingsLangQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormSettingsLangQuery(get_called_class());
    }
}
