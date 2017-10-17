<?php

namespace mrstroz\wavecms\form\models;

use Yii;

/**
 * This is the model class for table "form_settings".
 *
 * @property integer $id
 * @property string $type
 * @property string $send_email
 * @property string $from_name
 * @property string $from_email
 * @property string $recipient
 * @property string $subject
 * @property string $text
 * @property string $thanks_text
 */
class FormSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'form_settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text', 'thanks_text'], 'string'],
            [['send_email'], 'boolean'],
            [['type', 'from_name', 'from_email', 'recipient', 'subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms/form/main', 'ID'),
            'type' => Yii::t('wavecms/form/main', 'Type'),
            'send_email' => Yii::t('wavecms/form/main', 'Send email'),
            'from_name' => Yii::t('wavecms/form/main', 'From name'),
            'from_email' => Yii::t('wavecms/form/main', 'From email'),
            'recipient' => Yii::t('wavecms/form/main', 'Recipient'),
            'subject' => Yii::t('wavecms/form/main', 'Subject'),
            'text' => Yii::t('wavecms/form/main', 'Text'),
            'thanks_text' => Yii::t('wavecms/form/main', 'Thanks text'),
        ];
    }

    /**
     * @inheritdoc
     * @return FormSettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormSettingsQuery(get_called_class());
    }
}
