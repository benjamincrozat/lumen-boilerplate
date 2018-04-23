<?php

namespace App\Repositories;

use App\Contracts\PostsRepositoryContract;

/**
 * @property PostsRepository $next
 */
class PostsCacheRepository extends BaseCacheRepository implements PostsRepositoryContract
{
    /**
     * {@inheritdoc}
     */
    protected $tag = 'posts';

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function index(array $data)
    {
        return $this->remember(md5(serialize($data)), function () use ($data) {
            return $this->next->index($data);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function store(array $data)
    {
        $this->flush();

        return $this->next->store($data);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function show($id)
    {
        return $this->remember($id, function () use ($id) {
            return $this->next->show($id);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function update($id, array $data)
    {
        $this->flush();

        return $this->next->update($id, $data);
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->flush();

        $this->next->destroy($id);
    }
}
