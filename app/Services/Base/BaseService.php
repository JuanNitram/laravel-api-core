<?php


namespace App\Services\Base;

use Illuminate\Database\Eloquent\Model;

class BaseService
{
    /**
     * @var Model $model
     */
    private $model;

    /**
     * @var string $section
     */
    private $section;

    public function __construct(Model $model, string $section)
    {
        $this->model = $model;
        $this->section = $section;
    }

}
