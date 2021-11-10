<?php

namespace Source\Models;

use Source\Exceptions\AppException;

class Login extends Model
{
    private int $user_id;

    public function __construct()
    {
        $this->user_id = $_SESSION['user_id'] ?? 0;
    }

    public static function check(): bool
    {
        return (new self())->user_id ? true : false;
    }

    public static function attempt(array $credentials): bool
    {
        $user = User::find(['email' => $credentials['email']])->first();

        if ($user) {

            if (password_verify($credentials['password'], $user->password)) {

                $_SESSION['user_id'] = $user->id;

                return true;
            }

        }

        return false;
    }

    public static function user(): User|bool
    {
        if (self::check()) {

            $user =  User::find(['id' => (new self())->user_id])->first();

            if ($user) return $user;

            static::logout();

            throw new AppException('Usuário na sessão não foi encontrado na base de dados');

        }
        
        return false;
    }

    public static function logout()
    {
        $_SESSION['user_id'] = 0;
    }
}