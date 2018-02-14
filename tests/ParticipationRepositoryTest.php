<?php

use App\Models\Participation;
use App\Repositories\ParticipationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ParticipationRepositoryTest extends TestCase
{
    use MakeParticipationTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ParticipationRepository
     */
    protected $participationRepo;

    public function setUp()
    {
        parent::setUp();
        $this->participationRepo = App::make(ParticipationRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateParticipation()
    {
        $participation = $this->fakeParticipationData();
        $createdParticipation = $this->participationRepo->create($participation);
        $createdParticipation = $createdParticipation->toArray();
        $this->assertArrayHasKey('id', $createdParticipation);
        $this->assertNotNull($createdParticipation['id'], 'Created Participation must have id specified');
        $this->assertNotNull(Participation::find($createdParticipation['id']), 'Participation with given id must be in DB');
        $this->assertModelData($participation, $createdParticipation);
    }

    /**
     * @test read
     */
    public function testReadParticipation()
    {
        $participation = $this->makeParticipation();
        $dbParticipation = $this->participationRepo->find($participation->id);
        $dbParticipation = $dbParticipation->toArray();
        $this->assertModelData($participation->toArray(), $dbParticipation);
    }

    /**
     * @test update
     */
    public function testUpdateParticipation()
    {
        $participation = $this->makeParticipation();
        $fakeParticipation = $this->fakeParticipationData();
        $updatedParticipation = $this->participationRepo->update($fakeParticipation, $participation->id);
        $this->assertModelData($fakeParticipation, $updatedParticipation->toArray());
        $dbParticipation = $this->participationRepo->find($participation->id);
        $this->assertModelData($fakeParticipation, $dbParticipation->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteParticipation()
    {
        $participation = $this->makeParticipation();
        $resp = $this->participationRepo->delete($participation->id);
        $this->assertTrue($resp);
        $this->assertNull(Participation::find($participation->id), 'Participation should not exist in DB');
    }
}
