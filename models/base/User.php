<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $type
 * @property integer $status
 *
 * @property \app\models\Menu[] $menus
 * @property \app\models\OrderTicket[] $orderTickets
 * @property \app\models\ServiceElectricCar[] $serviceElectricCars
 * @property \app\models\ServiceFoodBeverage[] $serviceFoodBeverages
 * @property \app\models\ServiceTicket[] $serviceTickets
 * @property \app\models\UserProfile[] $userProfiles
 * @property string $aliasModel
 */
abstract class User extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const TYPE_ADMIN = 'Admin';
    const TYPE_USER = 'User';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'type'], 'required'],
            [['type'], 'string'],
            [['status'], 'integer'],
            [['username', 'password'], 'string', 'max' => 255],
            ['type', 'in', 'range' => [
                    self::TYPE_ADMIN,
                    self::TYPE_USER,
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('models', 'ID'),
            'username' => Yii::t('models', 'Username'),
            'password' => Yii::t('models', 'Password'),
            'type' => Yii::t('models', 'Type'),
            'status' => Yii::t('models', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(\app\models\Menu::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderTickets()
    {
        return $this->hasMany(\app\models\OrderTicket::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceElectricCars()
    {
        return $this->hasMany(\app\models\ServiceElectricCar::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceFoodBeverages()
    {
        return $this->hasMany(\app\models\ServiceFoodBeverage::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceTickets()
    {
        return $this->hasMany(\app\models\ServiceTicket::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfiles()
    {
        return $this->hasMany(\app\models\UserProfile::className(), ['user_id' => 'id']);
    }




    /**
     * get column type enum value label
     * @param string $value
     * @return string
     */
    public static function getTypeValueLabel($value){
        $labels = self::optsType();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column type ENUM value labels
     * @return array
     */
    public static function optsType()
    {
        return [
            self::TYPE_ADMIN => Yii::t('models', 'Admin'),
            self::TYPE_USER => Yii::t('models', 'User'),
        ];
    }

}
