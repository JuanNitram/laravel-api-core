<?php


namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Boolean;

interface ServiceInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param int $id
     * @return Model
     */
    public function get(int $id): ?Model;

    /**
     * @param int $id
     * @return bool
     */
    public function remove(int $id): Boolean;

    /**
     * @param array $data
     * @return array
     */
    public function save(array $data = []): array;

    /**
     * @param int   $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data = []): array;
}
