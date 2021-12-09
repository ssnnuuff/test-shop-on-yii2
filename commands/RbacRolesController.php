<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use \app\rbac\UserGroupRule;

class RbacRolesController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        $rule = new UserGroupRule;
        $auth->add($rule);

        $author = $auth->createRole('author');
        $author->ruleName = $rule->name;
        $auth->add($author);
        // ... add permissions as children of $author ...

        $manager = $auth->createRole('manager');
        $manager->ruleName = $rule->name;
        $auth->add($manager);
        // ... add permissions as children of $manager ...

        $admin = $auth->createRole('admin');
        $admin->ruleName = $rule->name;
        $auth->add($admin);
        $auth->addChild($admin, $author);
        $auth->addChild($admin, $manager);
        // ... add permissions as children of $admin ...
   }

}
