<?php

namespace mrstroz\wavecms\form\models;

use mrstroz\wavecms\components\behaviors\TranslateBehavior;
use mrstroz\wavecms\form\models\query\FormSettingsQuery;
use Yii;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "form_settings".
 *
 * @property integer $id
 * @property string $type
 * @property integer $send_email
 * @property string $from_name
 * @property string $from_email
 * @property string $recipient
 * @property string $subject
 * @property string $text
 * @property string $thanks_text
 * @property integer $user_send_email
 * @property string $user_from_name
 * @property string $user_from_email
 * @property string $user_subject
 * @property string $user_text
 */
class FormSettings extends \yii\db\ActiveRecord
{

    public $dataAttributes = [
        'created_at',
        'updated_at'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'form_settings';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'translate' => [
                'class' => TranslateBehavior::class,
                'translationAttributes' => [
                    'send_email', 'from_name', 'from_email', 'recipient', 'subject', 'text', 'thanks_text',
                    'user_send_email', 'user_from_name', 'user_from_email', 'user_subject', 'user_text'
                ]
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'string', 'max' => 255],
            [['send_email', 'user_send_email'], 'integer'],
            [['text', 'user_text', 'thanks_text'], 'string'],
            [['from_email'], 'email'],
            [['from_name', 'from_email', 'recipient', 'subject'], 'string', 'max' => 255],
            [['user_from_name', 'user_from_email', 'user_subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms_form/main', 'ID'),
            'type' => Yii::t('wavecms_form/main', 'Type'),
            'send_email' => Yii::t('wavecms_form/main', 'Send email'),
            'from_name' => Yii::t('wavecms_form/main', 'From name'),
            'from_email' => Yii::t('wavecms_form/main', 'From email'),
            'recipient' => Yii::t('wavecms_form/main', 'Recipient'),
            'subject' => Yii::t('wavecms_form/main', 'Subject'),
            'text' => Yii::t('wavecms_form/main', 'Text'),
            'thanks_text' => Yii::t('wavecms_form/main', 'Thanks text'),
            'user_send_email' => Yii::t('wavecms_form/main', 'Send email'),
            'user_from_name' => Yii::t('wavecms_form/main', 'From name'),
            'user_from_email' => Yii::t('wavecms_form/main', 'From email'),
            'user_subject' => Yii::t('wavecms_form/main', 'Subject'),
            'user_text' => Yii::t('wavecms_form/main', 'Text'),
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

    /**
     * Required for Translate behaviour
     * @return ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(FormSettingsLang::class, ['form_settings_id' => 'id']);
    }

    /**
     * Replace tags by values in text and subject field
     * @param Form $model
     * @throws \yii\base\InvalidArgumentException
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\base\InvalidParamException
     */
    public function replaceTags($model)
    {
        if (isset($model->attributes)) {
            foreach ($model->attributes as $key => $attribute) {
                if (in_array($key, $this->dataAttributes)) {
                    $val = Yii::$app->formatter->asDatetime($model->{$key}, 'short');
                } else {
                    $val = $model->{$key};
                }

                $this->subject = str_replace('{' . $key . '}', $val, $this->subject);
                $this->user_subject = str_replace('{' . $key . '}', $val, $this->user_subject);
                $this->text = str_replace('{' . $key . '}', $val, $this->text);
                $this->user_text = str_replace('{' . $key . '}', $val, $this->user_text);
            }
        }
    }

    /**
     * Replace additional tags in email subject and text
     * @param $tag
     * @param $value
     */
    public function replaceExtraTag($tag, $value)
    {
        $this->subject = str_replace('{' . $tag . '}', $value, $this->subject);
        $this->user_subject = str_replace('{' . $tag . '}', $value, $this->user_subject);
        $this->text = str_replace('{' . $tag . '}', $value, $this->text);
        $this->user_text = str_replace('{' . $tag . '}', $value, $this->user_text);
    }

}
