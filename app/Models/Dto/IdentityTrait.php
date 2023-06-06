<?php

namespace App\Models\Dto;

use Illuminate\Support\Carbon;

/**
 * Identity trait
 */
trait IdentityTrait
{
    /** @var int|null 아이디 */
    public ?int $id = null;
    /** @var Carbon|null 생성일시 */
    public ?Carbon $createdAt = null;
    /** @var Carbon|null 수정일시 */
    public ?Carbon $updatedAt = null;
    /** @var Carbon|null 삭제일시 */
    public ?Carbon $deletedAt = null;

    /**
     * JSON으로 직렬화해야 하는 데이터 지정하여 반환한다.
     *
     * @return mixed
     */
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
            'deletedAt' => $this->deletedAt,
        ];
    }

    /**
     * 개체가 복제될 때 수행이 된다.
     *
     * @return void
     */
    public function __clone(): void
    {
        if ($this->createdAt) {
            $this->createdAt = clone $this->createdAt;
        }
        if ($this->updatedAt) {
            $this->updatedAt = clone $this->updatedAt;
        }
        if ($this->deletedAt) {
            $this->deletedAt = clone $this->deletedAt;
        }
    }
}
