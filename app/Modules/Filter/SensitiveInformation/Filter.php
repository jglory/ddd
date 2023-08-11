<?php

namespace App\Modules\Filter\SensitiveInformation;

use App\Models\Dto\Dto;
use App\Modules\Transformer\Transformer;
use Traversable;

/**
 * Filter Base 클래스
 */
class Filter extends Transformer
{
    /**
     * 민감정보에 대한 필터링 메타데이터
     *
     * @var array
     */
    protected array $metadata;

    /**
     * 설정으로부터 민감정보 속성명 목록을 읽어들여 돌려준다.
     *
     * @param Dto $dto
     * @return array
     */
    private function queryMetadata(Dto $dto): array
    {
        return $this->metadata[$dto::class] ?? [];
    }

    /**
     * $dto 객체에서 대상이 되는 $name 필드에 대해 필터링 처리를 한다.
     *
     * @param Dto $dto
     * @param string $name
     * @return void
     */
    protected function filter(Dto $dto, string $name)
    {
        $dto->$name = null;
    }

    /**
     * 생성자
     *
     * @param array $metadata
     */
    public function __construct(array $metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     * $data를 필터링 처리하여 돌려준다.
     *
     * @param mixed $data
     * @return mixed
     */
    public function process(mixed $data): mixed
    {
        if ($data instanceof Dto) {
            $cloned = clone $data;
            $metadata = $this->queryMetadata($cloned);
            foreach ($cloned as $name => $value) {
                if (in_array($name, $metadata)) {
                    $this->filter($cloned, $name);
                    continue;
                }

                if ($cloned->$name instanceof Dto) {
                    $cloned->$name = $this->process($cloned->$name);
                    continue;
                }

                if (is_array($cloned->$name) || $cloned->$name instanceof Traversable) {
                    $cloned->$name = $this->process($cloned->$name);
                }
            }
            return $cloned;
        }

        if (is_array($data)) {
            $filtered = [];
            foreach ($data as $key => $item) {
                $filtered[$key] = $this->process($item);
            }
            return $filtered;
        }

        if ($data instanceof Traversable) {
            $cloned = clone $data;
            foreach ($data as $key => $item) {
                $cloned[$key] = $this->process($item);
            }
            return $cloned;
        }

        return $data;
    }
}
