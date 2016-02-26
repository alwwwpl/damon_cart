<?php

namespace app\models;

use Yii;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * 代理邀请码
 *
 * @property integer $invite_code_id
 * @property integer $agent_id
 * @property integer $status
 * @property string $code
 * @property string $date_added
 */
class InviteCode extends \yii\db\ActiveRecord
{
    const STATUS_UNUSED = 0;

    const STATUS_USED = 1;

    public static $statuses = [
        self::STATUS_UNUSED => '未使用',
        self::STATUS_USED => '已使用'
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'oc_invite_code';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['agent_id', 'status'], 'integer'],
            [['date_added'], 'safe'],
            [['code'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'invite_code_id' => '邀请码编号',
            'agent_id' => '代理',
            'status' => '状态',
            'code' => '推广码',
            'url' => '推广链接',
            'date_added' => '添加时间',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\query\InviteCodeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\InviteCodeQuery(get_called_class());
    }

    public function getAgent()
    {
        return $this->hasOne(Agent::className(), ['agent_id' => 'agent_id']);
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_added',
                'updatedAtAttribute' => null,
                'value' => function(){
                    return date('Y-m-d H:i:s');
                },
            ],
        ]);
    }

    public function beforeSave($insert){
        if(parent::beforeSave($insert)){
            $this->code = $this->genCode();

            return true;
        }

        return false;
    }

    public function genCode()
    {
        $code = substr(Yii::$app->getSecurity()->generateRandomString(), 0, 8);
        if(self::findOne(['code' => $code])){
            $code = $this->getCode();
        }

        return $code;
    }

    public function getStatusText()
    {
        return self::$statuses[$this->status];
    }

    public function getUrl($agent)
    {
        if($agent->type==Agent::TYPE_PROVINCE){
            $shareUrl =  Yii::$app->request->hostInfo .  '/agent/account/create?code=' . $this->code;
        }else{
            $shareUrl =  'http://iddmall.com/index.php?route=account/register&agent_id='.$agent->agent_id.'&code=' . $this->code;
        }

        return $shareUrl;
    }
}
