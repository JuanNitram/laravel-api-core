<?php


namespace App\Services;


use App\Models\Sections;
use Illuminate\Support\Collection;

class SectionsService
{
    /**
     * @var Sections
     */
    private $model;

    /**
     * SectionsService constructor.
     * @var Sections       $model
     */
    public function __construct(Sections $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @return Sections
     * @var int $id
     */
    public function get(int $id): Sections
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * @return bool
     * @var int $id
     */
    public function remove(int $id): bool
    {
        if($section = $this->model->where('id', $id)->first()){
            return $section->delete();
        }

        return false;
    }

    /**
     * @return array
     * @var array $data
     */
    public function save(array $data = []): array
    {
        $section = $this->model->create($data);

        return [
            'success' => true,
            'data' => [
                'section' => $section
            ],
            'message' => 'Section register successfully.'
        ];
    }

    /**
     * @return array
     * @var int   $id
     * @var array $data
     */
    public function update(int $id, array $data = []): array
    {
        // TO-DO
    }
}
