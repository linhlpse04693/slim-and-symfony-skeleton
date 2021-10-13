<?php

namespace App\Support;

use App\Models\User;
use Psr\Http\Message\ServerRequestInterface as Request;
use Firebase\JWT\JWT;
use Slim\Exception\HttpUnauthorizedException;

class Auth
{
    const HEADER = 'Authorization';
    const PREFIX = 'Bearer';

    public static function attempt($email, $password)
    {
        $password_exists_with_email = function ($attribute, $value, $fail) use ($email, $password) {

            $exists = User::where(compact('email', 'password'))->exists();

            if (!$exists) {
                $attribute = ucfirst($attribute);
                $fail("{$attribute} Is Invalid, doesn't line up with provided email");
            }
        };

        $validator = validator(
            compact('email', 'password'),
            [
                'email' => 'required|exists:users,email',
                'password' => ['required', 'exists:users,password', $password_exists_with_email],
            ],
            [
                'email.exists' => 'Email not found',
                'password.exists' => 'Password not found'
            ]
        );

        if ($validator->fails()) return false;

        $user = User::where('email', $email)->first();

        $key = config('app.key');
        $payload = array(
            'id' => $user->id,
            "iss" => config('app.url'),
            "aud" => config('app.url'),
            "iat" => time(),
            "expires_in" => time() + (60 * 60),
        );

        return [
            'access_token' => JWT::encode($payload, $key),
            'expires_in' => (60 * 60),
            'user' => $user,
        ];
    }

    public static function user()
    {
        $request = app()->resolve(Request::class);
        $header = $request->getHeaderLine('AUTHORIZATION');
        if (!$header) return null;
        $start = strlen(static::PREFIX);

        $token = trim(substr($header, $start));

        $key = config('app.key');

        $decoded = JWT::decode($token, $key, array('HS256'));

        $query = User::where('id', $decoded->id);

        app()->bind(
            Auth::class,
            $query->exists() ? $query->first() : false
        );

        return app()->resolve(Auth::class);
    }

    public static function check(): bool
    {
        return (bool)self::user();
    }

    public static function guest(): bool
    {
        return (bool)self::user() === false;
    }
}
