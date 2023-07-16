<?php


namespace App\Values\Http;

use App\Values\Value;

/**
 *  @OA\Schema(
 *      schema="App.Values.Http.Token",
 *      required={"value", "type", "expiresIn"},
 *      @OA\Property(property="value", type="string", description="토큰 값", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbC1zZWpvbmcuaGFwcHl0YWxrLmlvXC9hcGlcL2xvZ2luIiwiaWF0IjoxNjIxNDc5OTY5LCJleHAiOjE2MjE0ODM1NjksIm5iZiI6MTYyMTQ3OTk2OSwianRpIjoia1dESEZMMmlldVBsSlVOcyIsInN1YiI6NDUzMDMsInBydiI6IjE3MWYyNDUyMWZhZmQyZmU3YzY2NGIwNTgzNTVmZTM2YjEyYTA3N2YiLCJpZCI6NDUzMDMsInRva2VuIjoidkZZRHFGNlFXWmxBMlhtTjZhVHZTazRZZTFrYzhHcmhKd1hGbXFnRiJ9.fSpOKceheyGOL7kUkeWOQTtp0TLfS_zgxsFyc2lusG4"),
 *      @OA\Property(property="type", type="string", enum={"basic", "bearer", "digest", "hoba", "mutual", "aws4-hmac-sha256"}, description="토큰 타입", example="bearer"),
 *      @OA\Property(property="expiresIn", type="int", description="유효기간")
 * )
 *
 * HTTP Token 클래스
 * Class Token
 * @package App\Values\Http
 */
class Token extends Value
{
    /** @var string 토큰 값 */
    public readonly string $value;
    /** @var TokenType 토큰 타입 */
    public readonly TokenType $type;
    /** @var int 유효기간 */
    public readonly int $expiresIn;

    /**
     * Token constructor.
     * @param string $value
     * @param TokenType $type
     * @param int $expiresIn
     */
    public function __construct(string $value, TokenType $type, int $expiresIn)
    {
        $this->value = $value;
        $this->type = $type;
        $this->expiresIn = $expiresIn;
    }

    /**
     * JSON으로 직렬화해야 하는 데이터 지정하여 돌려준다.
     * @return array
     */
    public function jsonSerialize(): mixed
    {
        return [
            'value' => $this->value,
            'type' => $this->type,
            'expiresIn' => $this->expiresIn
        ];
    }
}
