<?php

namespace mrstroz\wavecms\form\models;

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
                'class' => TimestampBehavior::className(),
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
            [['created_at', 'updated_at'], 'integer'],
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
            'id' => Yii::t('wavecms/form/main', 'ID'),
            'language' => Yii::t('wavecms/base/main', 'Language'),
            'type' => Yii::t('wavecms/base/main', 'Type'),
            'name' => Yii::t('wavecms/form/main', 'Name'),
            'company' => Yii::t('wavecms/form/main', 'Company'),
            'email' => Yii::t('wavecms/form/main', 'Email'),
            'phone' => Yii::t('wavecms/form/main', 'Phone'),
            'subject' => Yii::t('wavecms/form/main', 'Subject'),
            'text' => Yii::t('wavecms/form/main', 'Text'),
            'created_at' => Yii::t('wavecms/base/main', 'Created At'),
            'updated_at' => Yii::t('wavecms/base/main', 'Updated At'),
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
