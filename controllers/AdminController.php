<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\db\Query;

class AdminController extends Controller
{
    /**
     * Configures behaviors for access control.
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'], // Only 'admin' role is allowed
                    ],
                ],
            ],
        ];
    }

    /**
     * Displays the profile page for admin.
     */
    public function actionProfile()
    {
        $user = Yii::$app->user->identity;

        // Fetch user registration data grouped by date
        $data = User::find()
            ->select(['DATE_FORMAT(FROM_UNIXTIME(created_at), "%Y-%m-%d") as date', 'COUNT(*) as count'])
            ->groupBy(['date'])
            ->orderBy(['date' => SORT_ASC])
            ->asArray()
            ->all();

        // Extract dates and counts
        $dates = array_column($data, 'date');
        $counts = array_map('intval', array_column($data, 'count'));

        return $this->render('profile', [
            'user' => $user,
            'dates' => $dates,
            'counts' => $counts,
        ]);
    }

    /**
     * Displays a list of users.
     */
    public function actionIndex()
    {
        $users = (new Query())
            ->select(['id', 'username', 'email', 'created_at'])
            ->from('user')
            ->all();

        return $this->render('index', [
            'users' => $users,
        ]);
    }

    /**
     * Displays a single user's details.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the user cannot be found
     */
    public function actionView($id)
    {
        $user = $this->findModel($id);
        return $this->render('view', ['user' => $user]);
    }

    /**
     * Creates a new user.
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing user.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the user cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes a user.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the user cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * @param int $id
     * @return User
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
