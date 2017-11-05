<?php

class ExampleIntegrationTest extends TestCase
{
    /** @test */
    public function it_works()
    {
        $this->json('GET', '/')
            ->assertResponseOk();
    }
}
