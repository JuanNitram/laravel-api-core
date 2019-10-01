<?php

namespace App\Services;

use App\Services\Base\BaseService;
use phpDocumentor\Reflection\Types\Boolean;
use App\Models\Sliders;

class SlidersService extends BaseService
{
    /**
     * SlidersService constructor.
     * @param Sliders       $model
     */
    public function __construct(Sliders $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $data
     * @return array
     */
    public function save(array $data = []): array
    {
        $slider = $this->model->create($data);

        if(isset($data['medias']) === true){
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
        if($slider = $this->model->where('id', $id)->first()){
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
}
