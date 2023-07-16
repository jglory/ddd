<?php

namespace App\Models\Entity;

use App\Models\Dto\Dto;
use Illuminate\Support\Carbon;

/**
 * Entity class
 */
abstract class Entity implements ToDtoInterface
{
    use IdentityTrait;

    /**
     * 입력된 dto 객체를 통해 이 객체를 생성이 가능한가 여부를 돌려준다.
     *
     * @return bool
     */
    abstract protected function isDtoConstructable(Dto $dto): bool;

    /**
     * 이 객체와 연관된 dto 객체를 생성하여 돌려준다.
     *
     * @return Dto
     */
    abstract protected function createDto(): Dto;

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @param Dto $dto
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(Dto $dto)
    {
        if ($this->isDtoConstructable($dto) === false) {
            throw new \InvalidArgumentException('잘못된 입력입니다.');
        }

        $this->id = guid();
        $this->createdAt = Carbon::now();
        foreach ($dto as $key => &$val) {
            if (($key === 'id' || $key === 'createdAt') && is_null($val)) {
                // id, createdAt 값이 있을 때만 복사
                continue;
            }
            $this->$key = $val;
        }
    }

    /**
     * 이 객체와 연관된 dto 객체로 변환하여 돌려준다.
     *
     * @return Dto
     */
    public function toDto(): Dto
    {
        $dto = $this->createDto();
        foreach ($dto as $key => &$val) {
            $dto->$key = $this->$key;
        }

        return $dto;
    }
}
