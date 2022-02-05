<?php

namespace common\models;

use daxslab\behaviors\UploaderBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "kyc".
 *
 * @property int $id
 * @property string|null $document_picture
 * @property string|null $self_picture
 * @property string|null $self_picture_with_doc
 * @property string|null $status
 * @property int|null $business_profile_id
 *
 * @property-read string $documentPictureUrl
 * @property-read string $selfPictureWithInfoUrl
 * @property-read string $selfPictureUrl
 * @property-read mixed $formattedStatus
 * @property BusinessProfile $businessProfile
 * @property string $code [varchar(6)]
 */
class Kyc extends \yii\db\ActiveRecord
{
    const KYC_STATUS_SENT = 'sent';
    const KYC_STATUS_ACCEPTED = 'accepted';
    const KYC_STATUS_CANCELLED = 'cancelled';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kyc';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                [
                    'class' => UploaderBehavior::class,
                    'renamer' => UploaderBehavior::RENAME_RANDOM,
                    'uploadPath' => '@backend/web/uploads'
                ]
            ]
        );
    }

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->code = strtoupper(substr(uniqid(), '-6'));
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'document_picture',
                'self_picture',
                'self_picture_with_doc'
            ], 'required'],
            [['business_profile_id'], 'default', 'value' => null],
            [['business_profile_id'], 'integer'],
            [[
                'status'
            ], 'string', 'on' => [self::KYC_STATUS_SENT, self::KYC_STATUS_ACCEPTED, self::KYC_STATUS_ACCEPTED],
            ],
            [['status'], 'default', 'value' => self::KYC_STATUS_SENT],
            [['business_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => BusinessProfile::className(), 'targetAttribute' => ['business_profile_id' => 'id']],
            [[
                'document_picture',
                'self_picture',
                'self_picture_with_doc'
            ], 'image', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg']],
            [['code'], 'string'],
            [['code'], 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'document_picture' => Yii::t('app', 'Document Picture'),
            'self_picture' => Yii::t('app', 'Self Picture'),
            'self_picture_with_doc' => Yii::t('app', 'Self Picture With Doc'),
            'status' => Yii::t('app', 'Status'),
            'business_profile_id' => Yii::t('app', 'Business Profile ID'),
        ];
    }

    /**
     * Gets query for [[BusinessProfileController]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBusinessProfile()
    {
        return $this->hasOne(BusinessProfile::className(), ['id' => 'business_profile_id']);
    }

    public static function getStatuses()
    {
        return [
            self::KYC_STATUS_SENT => ucfirst(self::KYC_STATUS_SENT),
            self::KYC_STATUS_ACCEPTED => ucfirst(self::KYC_STATUS_ACCEPTED),
            self::KYC_STATUS_CANCELLED => ucfirst(self::KYC_STATUS_CANCELLED),
        ];
    }

    public function getFormattedStatus()
    {
        return self::getStatuses()[$this->status];
    }


    public function getDocumentPictureUrl()
    {
        $host = Yii::$app->request->hostInfo;
        return (isset($this->document_picture) and is_file(Yii::getAlias("@backend/web/uploads/{$this->document_picture}")))
            ? $host . Yii::getAlias("@web/uploads/{$this->document_picture}")
            : $host . Yii::getAlias("@web/img/no_user_picture.png");
    }

    public function getSelfPictureUrl()
    {
        $host = Yii::$app->request->hostInfo;
        return (isset($this->self_picture) and is_file(Yii::getAlias("@backend/web/uploads/{$this->self_picture}")))
            ? $host . Yii::getAlias("@web/uploads/{$this->self_picture}")
            : $host . Yii::getAlias("@web/img/no_user_picture.png");
    }

    public function getSelfPictureWithInfoUrl()
    {
        $host = Yii::$app->request->hostInfo;
        return (isset($this->self_picture_with_doc) and is_file(Yii::getAlias("@backend/web/uploads/{$this->self_picture_with_doc}")))
            ? $host . Yii::getAlias("@web/uploads/{$this->self_picture_with_doc}")
            : $host . Yii::getAlias("@web/img/no_user_picture.png");
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        @unlink(Yii::getAlias("@backend/web/uploads/{$this->document_picture}"));
        @unlink(Yii::getAlias("@backend/web/uploads/{$this->self_picture}"));
        @unlink(Yii::getAlias("@backend/web/uploads/{$this->self_picture_with_doc}"));

        return true;
    }
}
