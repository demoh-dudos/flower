<?php
use app\models\User;
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
