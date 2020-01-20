<?php

namespace app\models;

use Yii;
use \app\models\base\ReportInTicket as BaseReportInTicket;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "report_in_ticket".
 */
class ReportInTicket extends BaseReportInTicket
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
}
