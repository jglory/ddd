<?php

namespace App\Models\Repository;

use \Closure;
use App\Models\Dto\Entity as Dto;
use App\Modules\Database\Factory;
use Illuminate\Support\Collection;

/**
 * Repository class
 */
abstract class Repository
{
    private Factory $factory;

    protected array $originals = [];

    protected array $selectors = [];

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param Dto|Dto[] $data
     *
     * @return void
     */
    protected function addDataToOriginals(Dto|array $data): void
    {
        if (is_array($data)) {
            foreach ($data as $item) {
                $class = get_class($item);
                if (isset($this->originals[$class]) === false) {
                    $this->originals[$class] = [];
                }
                $this->originals[$class][$item->id] = clone $item;
            }
        } else {
            $class = get_class($data);
            if (isset($this->originals[$class]) === false) {
                $this->originals[$class] = [];
            }
            $this->originals[$class][$data->id] = clone $data;
        }
    }

    /**
     * @param Specification $spec
     *
     * @return Collection
     */
//    public function find(Specification $spec): Collection
//    {
//        $result = $this->findOne($spec);
//        if (is_null($result)) {
//            return collect();
//        }
//
//        return collect($result);
//    }

    public function findOne(Specification $spec): ?Dto
    {
        $result = $this->find($spec);
        if (empty($result)) {
            return null;
        }

        return $result[0];
    }

    public function find(Specification $spec): ?array
    {
        if (isset($this->selectors[get_class($spec)]) === false) {
            throw new \LogicException('허용되지 않는 명세 객체입니다.');
        }

        $result = $this->selectors[get_class($spec)]->process($spec);
        if (empty($result)) {
            return $result;
        }
        $serialized = [];
        array_walk($result, Closure::bind(
            function (&$item, $key) use (&$serialized) {
                $serialized += $this->serialize($item);
            },
            $this
        ));
        $this->addDataToOriginals($serialized);

        return $result;
    }

    protected function originalsHaveItem(Dto $dto): bool
    {
        return isset($this->originals[get_class($dto)][$dto->id]);
    }

    protected function compareItemToOriginals(Dto $dto): bool
    {
        return $dto == $this->originals[get_class($dto)][$dto->id];
    }

    protected function saveOne(Dto $dto)
    {
        $serialized = $this->serialize($dto);
        foreach ($serialized as $item) {
            if ($this->originalsHaveItem($item)) {
                if ($this->compareItemToOriginals($item) === false) {
                    $this->update($item);
                    $this->addDataToOriginals($item);
                }
            } else {
                $this->insert($item);
                $this->addDataToOriginals($item);
            }
        }
    }

    /**
     * @param Dto|Dto[] $data
     *
     * @return void
     */
    public function save(Dto|array $data)
    {
        if (is_array($data)) {
            foreach ($data as $dto) {
                $this->saveOne($dto);
            }
        } else {
            $this->saveOne($data);
        }
    }

    protected function insert(Dto $dto): void
    {
        $this->factory->inserters(get_class($dto))->process($dto);
    }

    protected function update(Dto $dto): void
    {
        $this->factory->updaters(get_class($dto))->process($dto);
    }

    /**
     * @param Dto $dto
     * @return array
     */
    abstract protected function serialize($dto): array;
}
