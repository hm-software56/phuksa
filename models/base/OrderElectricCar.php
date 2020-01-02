<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "order_electric_car".
 *
 * @property integer $id
 * @property string $order_code
 * @property string $order_name
 * @property integer $quantity
 * @property double $price
 * @property string $status
 * @property string $order_date
 * @property integer $service_electric_car_id
 *
 * @property \app\models\ServiceElectricCar $serviceElectricCar
 * @property \app\models\OrderTicketHasCar[] $orderTicketHasCars
 * @property string $aliasModel
 */
abstract class OrderElectricCar extends \yii\db\ActiveRecord
{



    /**
    * ENUM field values
    */
    const STATUS_PEDDING = 'Pedding';
    const STATUS_PAID = 'Paid';
    const STATUS_CANCEL = 'Cancel';
    var $enum_labels = false;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_electric_car';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_code', 'order_name', 'quantity', 'price', 'status', 'order_date', 'service_electric_car_id'], 'required'],
            [['id', 'quantity', 'service_electric_car_id'], 'integer'],
            [['price'], 'number'],
            [['status'], 'string'],
            [['order_date'], 'safe'],
            [['order_code'], 'string', 'max' => 45],
            [['order_name'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['service_electric_car_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\ServiceElectricCar::className(), 'targetAttribute' => ['service_electric_car_id' => 'id']],
            ['status', 'in', 'range' => [
                    self::STATUS_PEDDING,
                    self::STATUS_PAID,
                    self::STATUS_CANCEL,
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
            'id' => Yii::t('app', 'ID'),
            'order_code' => Yii::t('app', 'Order Code'),
            'order_name' => Yii::t('app', 'Order Name'),
            'quantity' => Yii::t('app', 'Quantity'),
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
            'order_date' => Yii::t('app', 'Order Date'),
            'service_electric_car_id' => Yii::t('app', 'Service Electric Car ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceElectricCar()
    {
        return $this->hasOne(\app\models\ServiceElectricCar::className(), ['id' => 'service_electric_car_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderTicketHasCars()
    {
        return $this->hasMany(\app\models\OrderTicketHasCar::className(), ['order_electric_car_id' => 'id']);
    }




    /**
     * get column status enum value label
     * @param string $value
     * @return string
     */
    public static function getStatusValueLabel($value){
        $labels = self::optsStatus();
        if(isset($labels[$value])){
            return $labels[$value];
        }
        return $value;
    }

    /**
     * column status ENUM value labels
     * @return array
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_PEDDING => Yii::t('app', 'Pedding'),
            self::STATUS_PAID => Yii::t('app', 'Paid'),
            self::STATUS_CANCEL => Yii::t('app', 'Cancel'),
        ];
    }

}
