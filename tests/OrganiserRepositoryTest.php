<?php

use App\Models\Organiser;
use App\Repositories\OrganiserRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrganiserRepositoryTest extends TestCase
{
    use MakeOrganiserTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrganiserRepository
     */
    protected $organiserRepo;

    public function setUp()
    {
        parent::setUp();
        $this->organiserRepo = App::make(OrganiserRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOrganiser()
    {
        $organiser = $this->fakeOrganiserData();
        $createdOrganiser = $this->organiserRepo->create($organiser);
        $createdOrganiser = $createdOrganiser->toArray();
        $this->assertArrayHasKey('id', $createdOrganiser);
        $this->assertNotNull($createdOrganiser['id'], 'Created Organiser must have id specified');
        $this->assertNotNull(Organiser::find($createdOrganiser['id']), 'Organiser with given id must be in DB');
        $this->assertModelData($organiser, $createdOrganiser);
    }

    /**
     * @test read
     */
    public function testReadOrganiser()
    {
        $organiser = $this->makeOrganiser();
        $dbOrganiser = $this->organiserRepo->find($organiser->id);
        $dbOrganiser = $dbOrganiser->toArray();
        $this->assertModelData($organiser->toArray(), $dbOrganiser);
    }

    /**
     * @test update
     */
    public function testUpdateOrganiser()
    {
        $organiser = $this->makeOrganiser();
        $fakeOrganiser = $this->fakeOrganiserData();
        $updatedOrganiser = $this->organiserRepo->update($fakeOrganiser, $organiser->id);
        $this->assertModelData($fakeOrganiser, $updatedOrganiser->toArray());
        $dbOrganiser = $this->organiserRepo->find($organiser->id);
        $this->assertModelData($fakeOrganiser, $dbOrganiser->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOrganiser()
    {
        $organiser = $this->makeOrganiser();
        $resp = $this->organiserRepo->delete($organiser->id);
        $this->assertTrue($resp);
        $this->assertNull(Organiser::find($organiser->id), 'Organiser should not exist in DB');
    }
}
