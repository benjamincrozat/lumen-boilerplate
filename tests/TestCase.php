<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = '/api/v1';

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }

    /**
     * Assert that a validation error exists for a given field.
     *
     * @param string $field
     *
     * @return self
     */
    protected function seeValidationError(string $field)
    {
        return $this->seeJsonStructure([$field])
            ->seeStatusCode(422);
    }
}
