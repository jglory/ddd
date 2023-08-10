<?php

/**
 * 전체 클래스명에서 클래스이름 만 돌려준다.
 *
 * @param $class
 *
 * @return string
 */
function classNameFromClass($class)
{
    $toks = explode('\\', $class);

    return $toks[ubound($toks)];
}

/**
 * @param string $class
 * @param array $attributes
 *
 * @return \App\Models\Dto\Dto
 */
function dto(string $class, array $attributes): \App\Models\Dto\Dto
{
    $dto = new $class();
    foreach ($attributes as $key => &$val) {
        $dto->$key = $val;
    }

    return $dto;
}

/**
 * unique id 값을 생성하여 돌려준다.
 *
 * @return int
 */
function guid(): int
{
    return intval(app('snowflake')->id());
}

/**
 * 배열의 마지막 인덱스 번호를 돌려준다.
 *
 * @param Countable|array $countable
 *
 * @return int
 */
function ubound(Countable|array &$countable)
{
    return count($countable) - 1;
}
