<?php

class HomeControllerTest extends TestCase
{
    /** @test */
    function it_works()
    {
        $this->call('GET', '/');
        $this->assertResponseOk();
    }
}
