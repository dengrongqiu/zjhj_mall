<?php
/**
 * Created by IntelliJ IDEA.
 * User: luwei
 * Date: 2017/10/2
 * Time: 13:52
 */

namespace app\modules\admin\controllers;


use app\modules\admin\models\LoginForm;

class PassportController extends Controller
{
    public $layout = 'passport';

    public function behaviors()
    {
        return array_merge(parent::behaviors(), []);
    }

    public function actionLogin()
    {
        if (\Yii::$app->request->isPost) {
            $form = new LoginForm();
            $form->attributes = \Yii::$app->request->post();
            $this->renderJson($form->login());
        } else {
            return $this->render('login');
        }
    }

    public function actionLogout()
    {
        \Yii::$app->admin->logout();
        \Yii::$app->response->redirect(\Yii::$app->urlManager->createUrl(['admin']))->send();
    }
}