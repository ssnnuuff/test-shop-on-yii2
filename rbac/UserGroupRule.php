<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;

/**
 * Checks if user role matches
 */
class UserGroupRule extends Rule
{
    public $name = 'userGroup';

    public function execute($user, $item, $params)
    {
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;
            if ($item->name === 'admin') {
                return $role == 1;
            } elseif ($item->name === 'author') {
                return $role == 1 || $role == 2;
            } elseif ($item->name === 'manager') {
                return $role == 1 || $role == 3;
            }
        }
        return false;
    }
}
?>