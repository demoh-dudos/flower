<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $login
 * @property string $email
 * @property string $password
 * @property int $is_admin
 *
 * @property Cart[] $carts
 * @property Order[] $orders
 *
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    public static function findIdentityByAccessToken($token, $type =
    null)
    {
        return static::findOne(['access_token' => $token]);
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAuthKey()
    {
        return ;
    }
    public function validateAuthKey($authKey)
    {
        return ;
    }
    public function validatePassword($password){

 return $this->password==$password;
 }
    public static function findByLogin($login){
        return self::find()->where(['login'=> $login])->one();
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'login', 'email', 'password'], 'required'],
            [['name'], 'string', 'max' => 200],
            [['surname', 'patronymic', 'login', 'email', 'password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Имя пользователя',
            'email' => 'Email',
            'password' => 'Пароль',
        ];
    }

    /**
     * Gets query for [[Carts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarts()
    {
        return $this->hasMany(Cart::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['user_id' => 'id']);
    }
    
    
}
class RegForm extends User
{
    public $confirm_password;
    public $agree;
    public function rules()
    {

        return [
            [['name', 'surname', 'patronymic', 'login', 'email', 'password', 'confirm_password', 'agree'],
                'required'],
            [['name'], 'match', 'pattern'=>'/^[А-ЯЁа-яё]{5,}/u',
                'message'=>'Используйте минимум 5 русских букв'],
            [['password'], 'match', 'pattern'=>'/^[A-Za-z0-9]{5,}/',
                'message'=>'Используйте минимум 5 латинских букв и цифр'],
            [['email'], 'email'],
            [['confirm_password'], 'compare',
                'compareAttribute'=>'password'],
            [['email'], 'unique'],
            [['agree'], 'compare', 'compareValue'=>true,
                'message'=>''],
            [['name', 'surname', 'patronymic', 'email', 'password'], 'string', 'max' => 255],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'login' => 'Имя пользователя',
            'email' => 'Email',
            'password' => 'Пароль',
            'is_admin' => 'Is Admin',
            'confirm_password' => 'Повторите пароль',
            'agree' => 'Подтвердите согласие на обработку персональных
данных',
        ];
    }
}
