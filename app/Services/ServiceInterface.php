<?php


namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface ServiceInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @var int $id
     * @return Model
     */
    public function get(int $id): ?Model;

    /**
     * @var int $id
     * @return bool
     */
    public function remove(int $id): bool;

    /**
     * @var array $data
     * @return array
     */
    public function save(array $data = []): array;

    /**
     * @var int   $id
     * @var array $data
     * @return array
     */
    public function update(int $id, array $data = []): array;
}
