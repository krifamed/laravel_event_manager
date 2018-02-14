<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipationApiTest extends TestCase
{
    use MakeParticipationTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateParticipation()
    {
        $participation = $this->fakeParticipationData();
        $this->json('POST', '/api/v1/participations', $participation);

        $this->assertApiResponse($participation);
    }

    /**
     * @test
     */
    public function testReadParticipation()
    {
        $participation = $this->makeParticipation();
        $this->json('GET', '/api/v1/participations/'.$participation->id);

        $this->assertApiResponse($participation->toArray());
    }

    /**
     * @test
     */
    public function testUpdateParticipation()
    {
        $participation = $this->makeParticipation();
        $editedParticipation = $this->fakeParticipationData();

        $this->json('PUT', '/api/v1/participations/'.$participation->id, $editedParticipation);

        $this->assertApiResponse($editedParticipation);
    }

    /**
     * @test
     */
    public function testDeleteParticipation()
    {
        $participation = $this->makeParticipation();
        $this->json('DELETE', '/api/v1/participations/'.$participation->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/participations/'.$participation->id);

        $this->assertResponseStatus(404);
    }
}
