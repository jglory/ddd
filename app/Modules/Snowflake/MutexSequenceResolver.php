<?php

namespace App\Modules\Snowflake;

use Godruoyi\Snowflake\SequenceResolver;
use Godruoyi\Snowflake\Snowflake;
use SyncMutex;
use SyncSharedMemory;

class MutexSequenceResolver implements SequenceResolver
{
    protected SyncMutex $mutex;
    protected string $mutexName;
    protected int $mutexWait;
    protected SyncSharedMemory $sharedMemory;

    public function __construct(string $name, int $wait)
    {
        $this->mutex = new SyncMutex($name);
        $this->mutexName = $name;
        $this->mutexWait = $wait;
        $this->sharedMemory = new SyncSharedMemory($name, PHP_INT_SIZE*2);
    }

    protected function lock()
    {
        if ($this->mutex->lock($this->mutexWait) === false) {
            throw new \Exception('뮤텍스(' . $this->mutexName . ') 잠금에 실패하였습니다.');
        }
    }

    protected function unlock()
    {
        $this->mutex->unlock();
    }

    protected function read(&$timestamp, &$sequence)
    {
        if ($this->sharedMemory->first()) {
            $timestamp = $sequence = 0;
            return;
        }
        $timestamp = unpack('q', $this->sharedMemory->read(0, PHP_INT_SIZE))[1];
        $sequence = unpack('q', $this->sharedMemory->read(PHP_INT_SIZE, PHP_INT_SIZE))[1];
    }

    protected function write($timestamp, $sequence)
    {
        $this->sharedMemory->write(pack('qq', $timestamp, $sequence));
    }

    public function sequence(int $currentTimestamp)
    {
        $timestamp = null;
        $sequence = null;

        $this->lock();
        $this->read($timestamp, $sequence);

        if ($timestamp > $currentTimestamp) {
            // 스레드 간 경쟁으로 나중 진입한 것이 먼저 진입한 것보다 빠른 시각을 가질 수 있다.
            // 1636108369367, 1636101659191 이런 경우도 있었음
            // MAX_SEQUENCE 값을 반환하여 다음 회차를 돌도록 한다.
            $this->unlock();

            return 1 << Snowflake::MAX_SEQUENCE_LENGTH;
        }

        if ($timestamp === $currentTimestamp) {
            $this->write($timestamp, ++$sequence);
            $this->unlock();

            return $sequence;
        }

        $this->write($currentTimestamp, 0);
        $this->unlock();

        return 0;
    }
}
