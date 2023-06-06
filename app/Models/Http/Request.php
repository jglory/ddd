<?php

namespace App\Models\Http;

use App\Modules\Logging\Log as LogItem;
use Illuminate\Http\Request as Base;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

/**
 * Request class
 */
abstract class Request extends Base
{
    /**
     * 유효성 검사 규칙 정보를 돌려준다.
     *
     * @return array
     */
    abstract protected function getValidationRules(): array;

    /**
     * 유효성 검사 규칙 정보에 대한 메세지 배열을 돌려준다.
     *
     * @return array
     */
    abstract protected function getValidationMessages(): array;

    /**
     * 웹요청 데이터를 돌려준다.
     *
     * @return array
     */
    abstract protected function getData(): array;

    /**
     * 웹요청에 대한 유효성 검사를 수행한다.
     *
     * @return void
     * @throw \InvalidArgumentException
     */
    public function validate(): void
    {
        Log::info(new LogItem(__METHOD__, $this->getData()));

        $result = Validator::make($this->getData(), $this->getValidationRules(), $this->getValidationMessages());
        if ($result->fails()) {
            throw new \InvalidArgumentException($result->errors()->first());
        }
    }
}
