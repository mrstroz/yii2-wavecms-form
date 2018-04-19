<?php

namespace mrstroz\wavecms\form\models;

use mrstroz\wavecms\form\models\query\FormQuery;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "form".
 *
 * @property integer $id
 * @property string $language
 * @property string $type
 * @property string $name
 * @property string $company
 * @property string $email
 * @property string $phone
 * @property string $subject
 * @property string $text
 * @property integer $created_at
 * @property integer $updated_at
 */
class Form extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'form';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['created_at'], 'integer'],
            [['language'], 'string', 'max' => 50],
            [['email'], 'required'],
            [['email'], 'email'],
            [['type', 'name', 'company', 'email', 'phone', 'subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('wavecms_form/main', 'ID'),
            'language' => Yii::t('wavecms_form/main', 'Language'),
            'type' => Yii::t('wavecms_form/main', 'Type'),
            'name' => Yii::t('wavecms_form/main', 'Name'),
            'company' => Yii::t('wavecms_form/main', 'Company'),
            'email' => Yii::t('wavecms_form/main', 'Email'),
            'phone' => Yii::t('wavecms_form/main', 'Phone'),
            'subject' => Yii::t('wavecms_form/main', 'Subject'),
            'text' => Yii::t('wavecms_form/main', 'Text'),
            'created_at' => Yii::t('wavecms_form/main', 'Created At')
        ];
    }

    /**
     * @inheritdoc
     * @return FormQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FormQuery(get_called_class());
    }
}
