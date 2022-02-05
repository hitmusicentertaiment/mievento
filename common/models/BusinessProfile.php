<?php

namespace common\models;

use daxslab\behaviors\UploaderBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "business_profile".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $name
 * @property string|null $gender
 * @property int|null $age
 * @property string|null $ethnicity
 * @property string|null $hair_color
 * @property string|null $eye_color
 * @property float|null $height
 * @property string|null $measurements
 * @property string|null $affiliation
 * @property string|null $available_to
 * @property string|null $aviability
 * @property int|null $city_id
 *
 * @property City $city
 * @property User $user
 * @property Email $email
 * @property Kyc $kyc
 * @property Phone $phone
 * @property Post[] $posts
 * @property-read Picture[] $pictures
 * @property-read string $formattedAvailableTo
 * @property SocialNetwork $socialNetwork
 */
class BusinessProfile extends \yii\db\ActiveRecord
{

    const AVAILABLE_TO_MAN = "man";
    const AVAILABLE_TO_WOMAN = "woman";
    const AVAILABLE_TO_COUPLE = "couple";
    const AVAILABLE_TO_THREESOME = "threesome";
    const AVAILABLE_TO_ORGY = "orgy";

    const EYE_COLOR_GREEN = "green";
    const EYE_COLOR_BLUE = "blue";
    const EYE_COLOR_GRAY = "gray";
    const EYE_COLOR_BLACK = "black";
    const EYE_COLOR_HONEY = "honey";

    const ETHNIC_TYPE_AMERICAN_INDIAN = "american_indian";
    const ETHNIC_TYPE_ASIAN = "asian";
    const ETHNIC_TYPE_BLACK = "black";
    const ETHNIC_TYPE_HISPANIC = "hispanic";
    const ETHNIC_TYPE_HAWAIIAN = "hawaiian";
    const ETHNIC_TYPE_WHITE = "white";


    const AFFILIATION_TYPE_AGENCY = 'AGENCY';
    const AFFILIATION_TYPE_INDEPENDENT = 'INDEPENDENT';

    public $images;

    public $attributesChanged = false;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'business_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'age',
                'city_id',
                'height',
                'name',
                'ethnicity',
                'hair_color',
                'eye_color',
                'measurements',
                'affiliation',
                'available_to',
                'aviability',
                'gender'
            ], 'required'],
            [['user_id', 'age', 'city_id'], 'default', 'value' => null],
            [['user_id', 'city_id'], 'integer'],
            [['age'], 'integer', 'min' => 18],
            [['height'], 'number', 'max' => '10.0', 'tooBig' => "Please select a real height"],
            [['name', 'ethnicity', 'hair_color', 'eye_color', 'measurements', 'available_to', 'aviability'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 1],
            [['measurements'], 'match', 'pattern' => '[^\d+-\d+-\d+$]', 'message' => "Measurements must be in format Bust-Waist-Hips"],
            [['affiliation'], 'in', 'range' => array_keys(self::getAffiliationTypes())],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['attributesChanged'], 'boolean']

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'gender' => Yii::t('app', 'Gender'),
            'age' => Yii::t('app', 'Age'),
            'ethnicity' => Yii::t('app', 'Ethnicity'),
            'hair_color' => Yii::t('app', 'Hair Color'),
            'eye_color' => Yii::t('app', 'Eye Color'),
            'height' => Yii::t('app', 'Height (ft)'),
            'measurements' => Yii::t('app', 'Measurements (Bust-Waist-Hips)'),
            'affiliation' => Yii::t('app', 'Affiliation'),
            'available_to' => Yii::t('app', 'Available To'),
            'aviability' => Yii::t('app', 'Aviability'),
            'city_id' => Yii::t('app', 'City'),
        ];
    }


    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[Emails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmail()
    {
        return $this->hasOne(Email::className(), ['business_profile_id' => 'id']);
    }

    /**
     * Gets query for [[Kycs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKyc()
    {
        return $this->hasOne(Kyc::className(), ['business_profile_id' => 'id']);
    }

    /**
     * Gets query for [[Phones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhone()
    {
        return $this->hasOne(Phone::className(), ['business_profile_id' => 'id']);
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['business_profile_id' => 'id']);
    }

    /**
     * Gets query for [[SocialNetworks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocialNetwork()
    {
        return $this->hasOne(SocialNetwork::className(), ['business_profile_id' => 'id']);
    }

    public function getFormattedAvailableTo()
    {
        return self::getAvailableToItems()[$this->available_to];
    }

    public static function getAvailableToItems()
    {
        return [
            self::AVAILABLE_TO_MAN => "Man",
            self::AVAILABLE_TO_WOMAN => "Woman",
            self::AVAILABLE_TO_COUPLE => "Couple",
            self::AVAILABLE_TO_THREESOME => "Threesome",
            self::AVAILABLE_TO_ORGY => "Orgy",
        ];
    }

    public static function getEyeColors()
    {
        return [
            self::EYE_COLOR_GREEN => "Green",
            self::EYE_COLOR_BLUE => "Blue",
            self::EYE_COLOR_GRAY => "Gray",
            self::EYE_COLOR_BLACK => "Black",
            self::EYE_COLOR_HONEY => "Honey",
        ];
    }

    public static function getEthnicTypes()
    {
        return [
            self::ETHNIC_TYPE_AMERICAN_INDIAN => "American Indian",
            self::ETHNIC_TYPE_ASIAN => "Asian",
            self::ETHNIC_TYPE_BLACK => "Black",
            self::ETHNIC_TYPE_HISPANIC => "Hispanic",
            self::ETHNIC_TYPE_HAWAIIAN => "Hawaiian",
            self::ETHNIC_TYPE_WHITE => "White",
        ];
    }

    public function getPictures()
    {
        return $this->hasMany(Picture::class, ['business_profile_id' => 'id']);
    }

    public static function getAffiliationTypes()
    {
        return [
            self::AFFILIATION_TYPE_INDEPENDENT => 'Independent',
            self::AFFILIATION_TYPE_AGENCY => 'Agency'
        ];
    }

    public function getPicturesUrls()
    {
        return array_keys(ArrayHelper::map($this->pictures, 'url', 'url'));
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if(!$insert and $this->attributesChanged){
            $kyc = $this->kyc;
            $kyc->status = Kyc::KYC_STATUS_SENT;
            $kyc->save(false);
        }
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        foreach ($this->pictures as $picture) {
            $picture->delete();
        }

        $this->kyc->delete();

        return true;
    }
}
