<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\Types\Boolean;
use App\Models\Sliders;

class SlidersService
{
    /**
     * @var MediasService $mediasService
     */
    private $mediasService;

    /**
     * SlidersService constructor.
     * @param MediasService $mediasService
     */
    public function __construct(MediasService $mediasService)
    {
        $this->mediasService = $mediasService;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Sliders::orderBy('pos', 'asc')->get();
    }

    /**
     * @param int $id
     * @return Model
     */
    public function get(int $id): ?Model
    {
        return Sliders::where('id', $id)->first();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function remove(int $id): Boolean
    {
        if($slider = Sliders::where('id', $id)->first()){
            foreach($slider->media as $media)
                $media->delete();
            return $slider->delete();
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
            'message' => 'Slider not found.'
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function save(array $data = []): array
    {
        $slider = Sliders::create($data);

        if(isset($data['medias'])){
            $this->mediasService->storeMedias($slider, $data['medias']);
        }

        $success['slider'] = $slider;

        return [
            'success' => true,
            'data' => [
                'slider' => $slider
            ],
            'message' => 'Slider register successfully.'
        ];
    }

    /**
     * @param int   $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data = []): array
    {
        if($slider = Sliders::where('id', $id)->first()){
            $slider->update($data);

            if(isset($data['medias'])){
                $this->mediasService->storeMedias($slider, $data['medias']);
            }

            $success['slider'] = $slider;

            return [
                'success' => true,
                'data' => [
                    'slider' => $slider
                ],
                'message' => 'Slider updated successfully.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Slider not found.'
        ];
    }

    public function saveOrder(array $items): array
    {
        $index = 0;

        foreach($items as $id){
            $item = Sliders::where('id', $id)->first();
            $item->update([
                'pos' => $index,
            ]);
            $index++;
        }

        return [
            'success' => true,
            'message' => 'Sliders order saved succesfully.',
        ];
    }

    public function activeMany(array $items, Boolean $active): array
    {
        foreach($items as $id){
            $item = Sliders::where('id', $id)->first();
            if($item){
                $item->update([
                    'active' => $active,
                ]);
            }
        }

        return [
            'success' => true,
            'message' => 'Sliders activated succesfully.',
        ];
    }

    public function removeMany(array $items): array
    {
        foreach($items as $id){
            if($item = Sliders::where('id', $id)->first()){
                foreach($item->media as $media)
                    $media->delete();
                $item->delete();
            }
        }

        return [
            'success' => true,
            'message' => 'Sliders removed succesfully.',
        ];
    }
}
