<?php


namespace App\Services;


use App\Models\Products;
use Illuminate\Support\Collection;

class ProductsService
{
    /**
     * @var Products
     */
    private $model;

    /**
     * @var CategoriesService
     */
    private $categoriesService;

    /**
     * @var MediasService
     */
    private $mediasService;

    /**
     * ProductsService constructor.
     * @param Products          $model
     * @param CategoriesService $categoriesService
     */
    public function __construct(Products $model, CategoriesService $categoriesService, MediasService $mediasService)
    {
        $this->model = $model;
        $this->categoriesService = $categoriesService;
        $this->mediasService = $mediasService;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->orderBy('pos', 'asc')->get();
    }

    /**
     * @var int $id
     * @return Products
     */
    public function get(int $id): Products
    {
        return $this->model->where('id', $id)->first();
    }

    /**
     * @var int $id
     * @return bool
     */
    public function remove(int $id): bool
    {
        if($product = $this->model->where('id', $id)->first()){
            foreach($product->media as $media)
                $media->delete();
            return $product->delete();
        }

        return false;
    }

    /**
     * @param array $data
     * @return array
     */
    public function save(array $data = []): array
    {
        if(($category = $this->categoriesService->get($data['categories_id'])) !== null){
            $product = $this->model->create($data);

            if(isset($data['medias']) === true){
                $this->mediasService->storeMedias($product, $data['medias']);
            }

            if(isset($data['subcategories']) === true){
                if(count($category->subcategories) > 0){
                    foreach($data['subcategories'] as $data_sub){
                        $exist = false;
                        foreach($category->subcategories as $sub){
                            if($data_sub == $sub->id){
                                $exist = true;
                                break;
                            }
                        }
                    }

                    if(!$exist){
                        return [
                            'success' => false,
                            'message' => 'There is an invalid subcategory'
                        ];
                    }

                    $product->subcategories()->detach();
                    $product->subcategories()->attach($data['subcategories']);
                }
            } else {
                $product->subcategories()->detach();
                $product->subcategories()->attach([]);
            }

            $success['product'] = $product;

            return [
                'success' => true,
                'data' => [
                    'product' => $product
                ],
                'message' => 'Product register successfully.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Category not found.'
        ];
    }

    /**
     * @param int   $id
     * @param array $data
     * @return array
     */
    public function update(int $id, array $data = []): array
    {
        if($product = $this->model->where('id', $id)->first()){
            if(($category = $this->categoriesService->get($data['categories_id'])) !== null) {
                $product->update($data);

                if (isset($data['medias'])) {
                    $this->mediasService->storeMedias($product, $data['medias']);
                }

                if(isset($data['subcategories']) === true){
                    if(count($category->subcategories) > 0){
                        foreach($data['subcategories'] as $data_sub){
                            $exist = false;
                            foreach($category->subcategories as $sub){
                                if($data_sub == $sub->id){
                                    $exist = true;
                                    break;
                                }
                            }
                        }

                        if(!$exist){
                            return [
                                'success' => false,
                                'message' => 'There is an invalid subcategory'
                            ];
                        }

                        $product->subcategories()->detach();
                        $product->subcategories()->attach($data['subcategories']);
                    }
                } else {
                    $product->subcategories()->detach();
                    $product->subcategories()->attach([]);
                }

                $success['product'] = $product;

                return [
                    'success' => true,
                    'data' => [
                        'product' => $product
                    ],
                    'message' => 'Product updated successfully.'
                ];
            }

            return [
                'success' => false,
                'message' => 'Category not found.'
            ];
        }

        return [
            'success' => false,
            'message' => 'Product not found.'
        ];
    }
}
