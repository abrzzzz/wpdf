<?php 
namespace Abrz\WPDF\Services\JWT\Concrete;

use Carbon\Carbon;
use Firebase\JWT\JWT as JWTJWT;
use Firebase\JWT\Key;
use stdClass;

class JWT extends JWTJWT
{

    public function __construct(
        private $secretKey = '', 
        private $serverName = '',
        private $expireAt = '6', // minutes
        private $algo = 'HS512',
        private $headers = [],
    )
    {
        $this->secretKey = env('APP_KEY');
        $this->serverName = env('APP_URL');
    }

    public function setExpireAt(string $expireAt) : self
    {
        $this->expireAt = $expireAt;
        return $this;
    }

    public function setAlgo(string $algo) : self
    {
        $this->algo = $algo;
        return $this;
    }

    public function generate($payload = [], $headers = []) 
    {
        
        $issuedAt = Carbon::now();
        $data = [
            'iat'  => $issuedAt->timestamp,         // Issued at: time when the token was generated
            'iss'  => $this->serverName,                       // Issuer
            'nbf'  => $issuedAt->timestamp,         // Not before
            'exp'  => $issuedAt->addMinutes($this->expireAt),                           // Expire
        ];

        return self::encode( 
            array_merge($data, $payload),
            $this->secretKey, 
            $this->algo,
            null,
            $headers
        );
        
    }

    public function data($jwt)
    {   
        return self::decode($jwt, new Key($this->secretKey, $this->algo), $headers);
    }

    public function validate(string $token): bool
    {
        $token = self::decode($token, new Key($this->secretKey, $this->algo), $headers = new stdClass());
        $now = Carbon::now();
        if($token->iss !== $this->serverName ||
        $token->nbf > $now->timestamp || 
        $token->exp < $now->timestamp
        ){
            return false;
        }

        return true;
    }

}