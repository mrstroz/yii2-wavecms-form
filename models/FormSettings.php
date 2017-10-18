<?php

namespace mrstroz\wavecms\form\models;

use mrstroz\wavecms\components\behaviors\TranslateBehavior;
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
                'class' => TranslateBehavior::className(),
                'translationAttributes' => [
                    'send_email', 'from_name', 'from_email', 'recipient', 'subject', 'text', 'thanks_text'
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
            [['send_email'], 'integer'],
            [['text', 'thanks_text'], 'string'],
            [['from_email'], 'email'],
            [['from_name', 'from_email', 'recipient', 'subject'], 'string', 'max' => 255],
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
        return $this->hasMany(FormSettingsLang::className(), ['form_settings_id' => 'id']);
    }

    /**
     * Replace tags by values in text and subject field
     * @param Form $model
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
                $this->text = str_replace('{' . $key . '}', $val, $this->text);
            }
        }

    }

}
