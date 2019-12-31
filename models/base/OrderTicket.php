<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "order_ticket".
 *
 * @property integer $id
 * @property string $order_code
 * @property string $order_name
 * @property double $price
 * @property string $status
 * @property string $order_date
 * @property integer $service_ticket_id
 * @property integer $user_id
 *
 * @property \app\models\ServiceTicket $serviceTicket
 * @property \app\models\User $user
 * @property \app\models\OrderTicketHasCar $orderTicketHasCar
 * @property string $aliasModel
 */
abstract class OrderTicket extends \yii\db\ActiveRecord
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
        return 'order_ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_code', 'order_name', 'price', 'status', 'order_date', 'service_ticket_id', 'user_id'], 'required'],
            [['price'], 'number'],
            [['status'], 'string'],
            [['order_date'], 'safe'],
            [['service_ticket_id', 'user_id'], 'integer'],
            [['order_code', 'order_name'], 'string', 'max' => 255],
            [['service_ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\ServiceTicket::className(), 'targetAttribute' => ['service_ticket_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \app\models\User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'price' => Yii::t('app', 'Price'),
            'status' => Yii::t('app', 'Status'),
            'order_date' => Yii::t('app', 'Order Date'),
            'service_ticket_id' => Yii::t('app', 'Service Ticket ID'),
            'user_id' => Yii::t('app', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceTicket()
    {
        return $this->hasOne(\app\models\ServiceTicket::className(), ['id' => 'service_ticket_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\app\models\User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderTicketHasCar()
    {
        return $this->hasOne(\app\models\OrderTicketHasCar::className(), ['order_ticket_id' => 'id']);
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
