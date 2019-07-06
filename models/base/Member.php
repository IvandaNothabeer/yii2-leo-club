<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the base-model class for table "member".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $address
 * @property string $city
 * @property string $telephone
 * @property string $mobile
 * @property string $joined
 * @property string $email
 * @property integer $active
 * @property integer $membership
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \app\models\Dog[] $dogs
 * @property string $aliasModel
 */
abstract class Member extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
            ],
            [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'address', 'city', 'membership'], 'required'],
            [['address'], 'string'],
            [['joined'], 'safe'],
            [['active', 'membership'], 'integer'],
            [['firstname', 'lastname'], 'string', 'max' => 80],
            [['city'], 'string', 'max' => 255],
            [['telephone', 'mobile'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 40]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'address' => 'Address',
            'city' => 'City',
            'telephone' => 'Telephone',
            'mobile' => 'Mobile',
            'joined' => 'Joined',
            'email' => 'Email',
            'active' => 'Active',
            'membership' => 'Membership',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDogs()
    {
        return $this->hasMany(\app\models\Dog::className(), ['member_id' => 'id']);
    }


    
    /**
     * @inheritdoc
     * @return \app\models\MemberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\MemberQuery(get_called_class());
    }


}