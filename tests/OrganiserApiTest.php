<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrganiserApiTest extends TestCase
{
    use MakeOrganiserTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOrganiser()
    {
        $organiser = $this->fakeOrganiserData();
        $this->json('POST', '/api/v1/organisers', $organiser);

        $this->assertApiResponse($organiser);
    }

    /**
     * @test
     */
    public function testReadOrganiser()
    {
        $organiser = $this->makeOrganiser();
        $this->json('GET', '/api/v1/organisers/'.$organiser->id);

        $this->assertApiResponse($organiser->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOrganiser()
    {
        $organiser = $this->makeOrganiser();
        $editedOrganiser = $this->fakeOrganiserData();

        $this->json('PUT', '/api/v1/organisers/'.$organiser->id, $editedOrganiser);

        $this->assertApiResponse($editedOrganiser);
    }

    /**
     * @test
     */
    public function testDeleteOrganiser()
    {
        $organiser = $this->makeOrganiser();
        $this->json('DELETE', '/api/v1/organisers/'.$organiser->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/organisers/'.$organiser->id);

        $this->assertResponseStatus(404);
    }
}
