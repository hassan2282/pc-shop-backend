<?php

namespace App\Repositories\Media;

interface MediaRepositoryInterface
{
    public function create(array $media);

    public function find(int $id);
    public function delete(int $id);
}
