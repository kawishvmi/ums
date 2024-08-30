<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use Yii;

class User extends ActiveRecord implements IdentityInterface
{
    public $password;
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->created_at = time();
                $this->auth_key = \Yii::$app->security->generateRandomString();
                $this->access_token = Yii::$app->security->generateRandomString();
            }
            $this->updated_at = time();

            if (!empty($this->password)) {
                $this->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
            }

            // Assign the default role 'user'
            $auth = Yii::$app->authManager;
            $role = $auth->getRole('user');
            if ($role) {
                $this->on(self::EVENT_AFTER_INSERT, function ($event) use ($auth, $role) {
                    $auth->assign($role, $this->id);
                });
            }

            return true;
        }
        return false;
    }

    public function rules()
    {
        return [
            [['username', 'email'], 'required'],
            [['email'], 'email'],
            [['username', 'email'], 'string', 'max' => 255],
            [['password'], 'string', 'min' => 6], // Add rule for password
            [['created_at', 'updated_at'], 'integer'],
            [['password_hash', 'auth_key', 'access_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributes()
    {
        return ['id', 'username', 'email', 'password_hash', 'auth_key', 'access_token', 'created_at', 'updated_at'];
    }

    public static function tableName()
    {
        return '{{%user}}';
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new \yii\web\NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCreate()
    {
        $model = new User();

        if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
