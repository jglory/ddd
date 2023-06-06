<?php

namespace App\Modules\Mapper\EloquentToDto;

use App\Domains\User\Dtos\User as UserDto;
use App\Domains\User\Eloquents\User as UserEloquent;
use App\Models\Dto\Entity as Dto;
use App\Modules\Mapper\EloquentToDto as EloquentToDtoMapper;
use App\Modules\Mapper\Mapper;
use App\Values\Password;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

/**
 * eloquent 를 dto로 변환하여 주는 유틸리티 클래스
 */
abstract class Base extends Mapper
{
    protected EloquentToDtoMapper $mapper;

    /**
     * @param EloquentToDtoMapper $mapper
     */
    public function __construct()
    {
        $this->mapper = App::make(config('mapper.eloquent-to-dto'));
    }

    abstract protected function createDto(): Dto;

    abstract protected function copy(mixed $in, mixed $out): void;



    public function create(mixed $in): mixed
    {
        if (is_object($in) === false || $in instanceof Model === false) {
            throw new \InvalidArgumentException('잘못된 인자 형식입니다.');
        }

        $out = $this->createDto();
        $out->id = $in->id;
        $out->createdAt = $in->created_at;
        $out->updatedAt = $in->updated_at;
        $out->deletedAt = $in->deleted_at;
        $this->copy($in, $out);

        return $out;
    }

    private function user(UserEloquent $in, UserDto $out): void
    {
        $out->name = $in->name;
        $out->email = $in->email;
        $out->emailVerifiedAt = $in->email_verified_at;
        $out->password = new Password($in->password, true);
        $out->rememberToken = $in->remember_token;
    }
}
