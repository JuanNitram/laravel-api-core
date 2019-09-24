<?php


namespace App\Services;


use App\Models\Subcategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SubcategoriesService
{
    /**
     * @var Categories
     */
    private $model;

    /**
     * CategoriesService constructor.
     * @var Subcategories $model
     */
    public function __construct(Subcategories $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        // TODO: Implement all() method.
    }

    /**
     * @return Model
     * @var int $id
     */
    public function get(int $id): ?Model
    {
        // TODO: Implement get() method.
    }

    /**
     * @return bool
     * @var int $id
     */
    public function remove(int $id): bool
    {
        // TODO: Implement remove() method.
    }

    /**
     * @return array
     * @var array $data
     */
    public function save(array $data = []): array
    {
        // TODO: Implement save() method.
    }

    /**
     * @return array
     * @var array $data
     * @var int   $id
     */
    public function update(int $id, array $data = []): array
    {
        // TODO: Implement update() method.
    }
}
