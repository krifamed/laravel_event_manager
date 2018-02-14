<?php

use Faker\Factory as Faker;
use App\Models\Organiser;
use App\Repositories\OrganiserRepository;

trait MakeOrganiserTrait
{
    /**
     * Create fake instance of Organiser and save it in database
     *
     * @param array $organiserFields
     * @return Organiser
     */
    public function makeOrganiser($organiserFields = [])
    {
        /** @var OrganiserRepository $organiserRepo */
        $organiserRepo = App::make(OrganiserRepository::class);
        $theme = $this->fakeOrganiserData($organiserFields);
        return $organiserRepo->create($theme);
    }

    /**
     * Get fake instance of Organiser
     *
     * @param array $organiserFields
     * @return Organiser
     */
    public function fakeOrganiser($organiserFields = [])
    {
        return new Organiser($this->fakeOrganiserData($organiserFields));
    }

    /**
     * Get fake data of Organiser
     *
     * @param array $postFields
     * @return array
     */
    public function fakeOrganiserData($organiserFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'name' => $fake->word,
            'description' => $fake->text,
            'user_id' => $fake->randomDigitNotNull
        ], $organiserFields);
    }
}
