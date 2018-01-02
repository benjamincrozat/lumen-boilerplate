<?php

namespace App\Contracts;

interface RepositoryContract
{
    public function list(array $data);

    public function store(array $data);

    public function get($key);

    public function update($key, array $data);

    public function delete($key);
}
