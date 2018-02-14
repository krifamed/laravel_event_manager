<?php

use Faker\Factory as Faker;
use App\Models\Participation;
use App\Repositories\ParticipationRepository;

trait MakeParticipationTrait
{
    /**
     * Create fake instance of Participation and save it in database
     *
     * @param array $participationFields
     * @return Participation
     */
    public function makeParticipation($participationFields = [])
    {
        /** @var ParticipationRepository $participationRepo */
        $participationRepo = App::make(ParticipationRepository::class);
        $theme = $this->fakeParticipationData($participationFields);
        return $participationRepo->create($theme);
    }

    /**
     * Get fake instance of Participation
     *
     * @param array $participationFields
     * @return Participation
     */
    public function fakeParticipation($participationFields = [])
    {
        return new Participation($this->fakeParticipationData($participationFields));
    }

    /**
     * Get fake data of Participation
     *
     * @param array $postFields
     * @return array
     */
    public function fakeParticipationData($participationFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'client_id' => $fake->randomDigitNotNull,
            'event_id' => $fake->randomDigitNotNull
        ], $participationFields);
    }
}
