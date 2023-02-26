<?php


namespace common\models;


use Yii;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;


/**
 *
 * @property-read string $profileFullName
 */
class User extends \Da\User\Model\User
{

    public function fields()
    {
        return [
            'id',
            'username',
            'email',
        ];
    }

    public function extraFields()
    {
        return [
            'profile',
            'roles',
            'profileFullName',
            'documents',
            'invitedEvents',
            'ownedEvents',
            'place',
            'reactions',
            'reservations',
            'revews'
        ];
    }


    /**
     * @return string
     */
    public function getProfileFullName()
    {
        return !is_null($this->profile) ? $this->profile->name . " " . $this->profile->first_surname . " " . $this->profile->second_surname : '';
    }

    /**
     * @inheritdoc
     *
     */
    public function afterSave($insert, $changedAttributes)
    {
        ActiveRecord::afterSave($insert, $changedAttributes);
    }

    public function getReactions()
    {
        return $this->hasMany(Reaction::class, ['user_id' => 'id']);
    }

    public function getReviews()
    {
        return $this->hasMany(Review::class, ['user_id' => 'id']);
    }

    public function getOwnedEvents()
    {
        return $this->hasMany(Event::class, ['user_id' => 'id']);
    }

    public function getInvitedEvents()
    {
        return $this->hasMany(Event::class, ['id' => 'event_id'])
            ->viaTable("tagged_user", ['user_id' => 'id']);
    }

    public function getReservations()
    {
        return $this->hasMany(Reservation::class, ['user_id' => 'id']);
    }

    public function getDocuments()
    {
        return $this->hasMany(Document::class, ['user_id' => 'id']);
    }

    public function getPlace()
    {
        return $this->hasMany(Place::class, ['user_id' => 'id']);
    }



}
