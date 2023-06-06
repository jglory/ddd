<?php

namespace App\Models\Entity;

use Illuminate\Support\Carbon;

/**
 * Identity Trait
 */
trait IdentityTrait
{
    /** @var int 아이디 */
    protected int $id;
    /** @var Carbon 생성일시 */
    protected Carbon $createdAt;
    /** @var Carbon|null 수정일시 */
    protected ?Carbon $updatedAt = null;
    /** @var Carbon|null 삭제일시 */
    protected ?Carbon $deletedAt = null;
}
