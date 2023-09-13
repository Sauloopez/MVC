<?php

use Carbon\Carbon;

class Auth
{
    public string $role;
    public string $username;
    public static $roles = ['user', 'admin', 'visitor'];
    public function __construct($username, $role)
    {
        $this->username=$username;
        $this->role=in_array($role, Auth::$roles)?$role:'visitor';
    }

    public static function validToken()
    {
        if (isset($_SESSION['jwt'])) {echo 'hola';
            $jwt = $_SESSION['jwt'];
            $tokenParts = explode('.', $jwt);
            $header = base64_decode($tokenParts[0]);
            $payload = base64_decode($tokenParts[1]);
            $signatureProvided = $tokenParts[2];
            
            $signature = hash_hmac(
                'sha256',
                Auth::base64UrlEncode($header) . "." .
                Auth::base64UrlEncode($payload),
                SECRET,
                true
            );
            if ($signature == $signatureProvided) {
                if (Carbon::now()->getTimestamp() > json_decode($payload)->exp) {
                    session_destroy();
                    unset($_SESSION['jwt']);
                    header('Location: '. URL.'home/login');
                    return null;
                }
                $role = in_array(json_decode($payload)->role, Auth::$roles) ? json_decode($payload)->role : '';
                $user = json_decode($payload)->user;
                return new Auth($user, $role);
            }else{
                return null;
            }
        }else{
            return null;
        }
    }

    public static function createToken(Auth $auth)
    {
        session_start();
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);

        // Create the token payload
        $payload = json_encode([
            'user_id' => $auth->username,
            'role' => $auth->role,
            'exp' => Carbon::now()->addMinutes(1)->getTimestamp()
        ]);
        $base64UrlHeader = Auth::base64UrlEncode($header);

        // Encode Payload
        $base64UrlPayload = Auth::base64UrlEncode($payload);

        // Create Signature Hash
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, SECRET, true);

        // Encode Signature to Base64Url String
        $base64UrlSignature = Auth::base64UrlEncode($signature);

        // Create JWT
        $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
        $_SESSION['jwt'] = $jwt;
    }
    private static function base64UrlEncode($text)
    {
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            base64_encode($text)
        );
    }
}