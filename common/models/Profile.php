<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $birth_date
 * @property int $gender
 */
class Profile extends \yii\db\ActiveRecord
{
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'phone', 'birth_date', 'gender'], 'required'],
            [['birth_date'], 'safe'],
            [['gender'], 'integer'],
            [['name', 'surname'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'surname' => Yii::t('app', 'Surname'),
            'phone' => Yii::t('app', 'Phone'),
            'birth_date' => Yii::t('app', 'Birth Date'),
            'gender' => Yii::t('app', 'Gender'),
        ];
    }

    /**
     * @return array
     */
    public function getGenderList()
    {
        return [
            self::GENDER_MALE => Yii::t('app', 'M'),
            self::GENDER_FEMALE => Yii::t('app', 'F'),
        ];
    }
}
