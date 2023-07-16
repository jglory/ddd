<?php

namespace App\Models\Aggregate;

use App\Models\Dto\Entity as Dto;
use App\Models\Entity\IdentityTrait;
use App\Models\Entity\ToDtoInterface;
use Illuminate\Support\Carbon;

/**
 * Aggregate class
 */
abstract class Aggregate implements ToDtoInterface
{
    use IdentityTrait;

    /**
     * 입력된 dto 객체를 통해 이 객체를 생성이 가능한가 여부를 돌려준다.
     *
     * @return bool
     */
    abstract protected function isDtoConstructable(Dto $dto): bool;

    /**
     * 입력된 dto 객체를 통해 이 객체를 초기화한다.
     *
     * @param Dto $dto
     *
     * @return void
     */
    abstract protected function initialize(Dto $dto): void;

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

        $this->id = $dto->id ?? guid();
        $this->createdAt = $dto->createdAt ?? Carbon::now();
        $this->updatedAt = $dto->updatedAt ?? $this->createdAt;
        $this->deletedAt = $dto->deletedAt;
        $this->initialize($dto);
    }
}
