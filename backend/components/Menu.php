<?php

namespace backend\components;

use rmrevin\yii\fontawesome\FAS;
use Yii;

class Menu
{
    public static function getItems()
    {
        if (Yii::$app->user->can('admin')) {
            return self::getAdminItems();
        }elseif(Yii::$app->user->can('client')){
            return self::getClientItems();
        }
        return [];
    }

    public static function getAdminItems()
    {
        $items = [
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>Countries</p>',
                    ['icon' => FAS::icon(FAS::_FLAG)]
                ),
    //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//country/index'],
                'action' => '/country/index',
                
                'options' => [
                    'class' => 'nav-item'
                ]
            ],
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>States</p>',
                    ['icon' => FAS::icon(FAS::_FLAG_CHECKERED)]
                ),
    //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//state/index'],
                'action' => '/state/index',
                'options' => [
                    'class' => 'nav-item'
                ]
            ],
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>Cities</p>',
                    ['icon' => FAS::icon(FAS::_FLAG_CHECKERED)]
                ),
    //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//city/index'],
                'action' => '/city/index',
                'options' => [
                    'class' => 'nav-item'
                ]
            ],
            
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>Locations</p>',
                    ['icon' => FAS::icon(FAS::_MAP_PIN)]
                ),
    //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//location/index'],
                'action' => '/location/index',
                'options' => [
                    'class' => 'nav-item'
                ]
            ],
            
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>Service</p>',
                    ['icon' => FAS::icon(FAS::_HAND_HOLDING)]
                ),
    //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//service/index'],
                'action' => '/service/index',
                'options' => [
                    'class' => 'nav-item'
                ]
            ],
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>Post types</p>',
                    ['icon' => FAS::icon(FAS::_CHECK)]
                ),
    //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//post-type/index'],
                'action' => '/post-type/index',
                'options' => [
                    'class' => 'nav-item'
                ]
            ],
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>Speciality Categories</p>',
                    ['icon' => FAS::icon(FAS::_CHECK)]
                ),
    //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//speciality-category/index'],
                'action' => '/speciality-category/index',
                'options' => [
                    'class' => 'nav-item'
                ]
            ],
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>Profiles</p>',
                    ['icon' => FAS::icon(FAS::_USERS)]
                ),
    //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//business-profile/index'],
                'action' => '/business-profile/index',
                'options' => [
                    'class' => 'nav-item'
                ]
            ],
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>Payments</p>',
                    ['icon' => FAS::icon(FAS::_HAND_HOLDING_USD)]
                ),
    //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//payment/index'],
                'action' => '/payment/index',
                'options' => [
                    'class' => 'nav-item'
                ]
            ],
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>KYC</p>',
                    ['icon' => FAS::icon(FAS::_USER_SECRET)]
                ),
    //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//kyc/index'],
                'action' => '/kyc/index',
                'options' => [
                    'class' => 'nav-item'
                ]
            ],
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>Posts</p>',
                    ['icon' => FAS::icon(FAS::_SHIELD_ALT)]
                ),
                //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//post/index'],
                'action' => '/post/index',
                'options' => [
                    'class' => 'nav-item'
                ]
            ],
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>System Users</p>',
                    ['icon' => FAS::icon(FAS::_USER_COG)]
                ),
    //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//user/admin/index'],
                'action' => '//user/admin/index',
                'options' => [
                    'class' => 'nav-item'
                ]
            ],



        ];

        return $items;
    }

    public static function getClientItems()
    {
        return [
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>Posts</p>',
                    ['icon' => FAS::icon(FAS::_SHIELD_ALT)]
                ),
                //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//post/my-posts'],
                'action' => '/post/my-posts',

                'options' => [
                    'class' => 'nav-item'
                ]
            ],
            [
                'label' => Yii::t(
                    'app',
                    '{icon} <p>Profiles</p>',
                    ['icon' => FAS::icon(FAS::_USER_FRIENDS)]
                ),
    //                    ['icon' => Html::tag('i', null, ['class' => 'far fa-circle nav-icon'])]),
                'url' => ['//business-profile/my-profiles'],
                'action' => '/business-profile/my-profiles',
                
                'options' => [
                    'class' => 'nav-item'
                ]
            ],
        ];
    }
}
