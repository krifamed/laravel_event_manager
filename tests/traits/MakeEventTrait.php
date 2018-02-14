<?php

use Faker\Factory as Faker;
use App\Models\Event;
use App\Repositories\EventRepository;

trait MakeEventTrait
{
    /**
     * Create fake instance of Event and save it in database
     *
     * @param array $eventFields
     * @return Event
     */
    public function makeEvent($eventFields = [])
    {
        /** @var EventRepository $eventRepo */
        $eventRepo = App::make(EventRepository::class);
        $theme = $this->fakeEventData($eventFields);
        return $eventRepo->create($theme);
    }

    /**
     * Get fake instance of Event
     *
     * @param array $eventFields
     * @return Event
     */
    public function fakeEvent($eventFields = [])
    {
        return new Event($this->fakeEventData($eventFields));
    }

    /**
     * Get fake data of Event
     *
     * @param array $postFields
     * @return array
     */
    public function fakeEventData($eventFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'deleted_at' => $fake->date('Y-m-d H:i:s'),
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'title' => $fake->word,
            'description' => $fake->text,
            'places' => $fake->randomDigitNotNull,
            'public' => $fake->word,
            'owner' => $fake->randomDigitNotNull,
            'start' => $fake->date('Y-m-d H:i:s'),
            'end' => $fake->date('Y-m-d H:i:s')
        ], $eventFields);
    }
}
