<?php

/**
 * See documentation about the "Exception" class in PHP before trying to
 * make sense of this test: http://php.net/manual/class.exception.php.
 *
 * @covers \App\Exceptions\Handler
 */
class ExceptionsHandlerTest extends TestCase
{
    /** @test */
    public function it_renders_html_exceptions()
    {
        $this->get('/foo')
            ->seeStatusCode(404)
            ->assertContains('<!DOCTYPE html>', $this->response->getContent());
    }

    /** @test */
    public function it_translates_exceptions_to_json()
    {
        $this->json('GET', '/foo')
            // NotFoundHttpException is thrown.
            ->seeStatusCode($expected = 404)
            ->seeJsonEquals([
                'code'    => $expected,
                'message' => '', // Expected empty message.
            ]);
    }
}
