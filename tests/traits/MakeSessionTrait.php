<?php

use Faker\Factory as Faker;
use App\Models\Session;
use App\Repositories\SessionRepository;

trait MakeSessionTrait
{
    /**
     * Create fake instance of Session and save it in database
     *
     * @param array $sessionFields
     * @return Session
     */
    public function makeSession($sessionFields = [])
    {
        /** @var SessionRepository $sessionRepo */
        $sessionRepo = App::make(SessionRepository::class);
        $theme = $this->fakeSessionData($sessionFields);
        return $sessionRepo->create($theme);
    }

    /**
     * Get fake instance of Session
     *
     * @param array $sessionFields
     * @return Session
     */
    public function fakeSession($sessionFields = [])
    {
        return new Session($this->fakeSessionData($sessionFields));
    }

    /**
     * Get fake data of Session
     *
     * @param array $postFields
     * @return array
     */
    public function fakeSessionData($sessionFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'title' => $fake->word,
            'start_date' => $fake->date('Y-m-d H:i:s'),
            'end_date' => $fake->date('Y-m-d H:i:s'),
            'payed' => $fake->word,
            'description' => $fake->text,
            'speaker' => $fake->word,
            'day_id' => $fake->randomDigitNotNull
        ], $sessionFields);
    }
}
