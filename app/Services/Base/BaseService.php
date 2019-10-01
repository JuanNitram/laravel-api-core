<?php


namespace App\Services\Base;


use App\Services\MediasService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseService
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @var MediasService
     */
    protected $mediasService;

    /**
     * BaseService constructor.
     * @param Model         $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->mediasService = new MediasService();
    }

    /**
     * @param array $relations
     * @return Collection
     */
    public function all(array $relations = []): Collection
    {
        return $this->model->with($relations)->get();
    }

    /**
     * @param int   $id
     * @param array $relations
     * @return Model
     */
    public function get(int $id, array $relations = []): Model
    {
        return $this->model->where('id', $id)->with($relations)->first();
    }

    /**
     * @param array $items
     * @return array
     */
    public function saveOrder(array $items): array
    {
        $index = 0;

        foreach($items as $id){
            $item = $this->model->where('id', $id)->first();
            $item->update([
                'pos' => $index,
            ]);
            $index++;
        }

        return [
            'success' => true,
            'message' => 'Order saved successfully.',
        ];
    }

    /**
     * @param array $items
     * @param bool  $active
     * @return array
     */
    public function toggleMany(array $items, bool $active): array
    {
        foreach($items as $id){
            $item = $this->model->where('id', $id)->first();
            if($item){
                $item->update([
                    'active' => $active,
                ]);
            }
        }

        return [
            'success' => true,
            'message' => 'Toggled successfully.',
        ];
    }

    /**
     * @param int $id
     * @return bool
     */
    public function remove(int $id): bool
    {
        if($item = $this->model->where('id', $id)->first()){
            if($item->media !== null){
                foreach($item->media as $media)
                    $media->delete();
            }
            return $item->delete();
        }

        return false;
    }

    /**
     * @param int $id
     * @return array
     */
    public function removeMedia(int $id): array
    {
        if($result = $this->mediasService->removeMedia($id)){
            return [
                'success' => true,
                'message' => 'Media removed successfully.'
            ];
        };

        return [
            'success' => false,
            'message' => 'Model not found.'
        ];
    }

    /**
     * @param array $items
     * @return array
     */
    public function removeMany(array $items): array
    {
        foreach($items as $id){
            if($item = $this->model->where('id', $id)->first()){
                foreach($item->media as $media)
                    $media->delete();
                $item->delete();
            }
        }

        return [
            'success' => true,
            'message' => 'Removed successfully.',
        ];
    }
}
