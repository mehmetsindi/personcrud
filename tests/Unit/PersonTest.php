<?php

namespace Tests\Unit;

use App\Modules\Person\Models\PersonModel;
use Tests\TestCase;


class PersonTest extends TestCase
{

    public function test_can_list_persone()
    {
        $response = $this->get('/person');

        $response->assertStatus(200);
    }
    /**
     * A basic unit test create.
     *
     * @return void
     */
    public function test_can_create_person()
    {

        $data = [
            'fuse' => 'person',
            'fuseAction' => 'create',
            'name' => 'test',
            'birthday' => '1992-10-1',
            'gender' => 'other'
        ];

        $this->post(route('person'), $data)
            ->assertStatus(200);
    }

    /**
     * A basic unit test update.
     *
     * @return void
     */
    public function test_can_update_person()
    {

        $person = PersonModel::factory()->create();

        $data = [
            'fuse' => 'person',
            'fuseAction' => 'update',
            'slug' => $person->slug,
            'name' => 'test',
            'birthday' => '1992-10-1',
            'gender' => 'other'
        ];


        $this->post(route('person'), $data)
            ->assertStatus(302);
    }

    /**
     * A basic unit test delete.
     *
     * @return void
     */
    public function test_can_delete_person()
    {

        $person = PersonModel::factory()->create();

        $data = [
            'fuse' => 'person',
            'fuseAction' => 'delete',
            'slug' => $person->slug,
        ];

        $this->post(route('person'), $data)
            ->assertStatus(302);
    }
}
