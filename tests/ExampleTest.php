<?php

use App\Device;
use App\RFDevice;
use App\User;
use App\UserDevice;

class ExampleTest extends TestCase
{

    private static $faker;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        self::$faker = \Faker\Factory::create();
    }

    public function testAdd_CallsAddForModels()
    {
        $mockDeviceModel = Mockery::mock(Device::class);
        $mockDeviceModel->shouldReceive('add')->withAnyArgs()->once();
        $this->app->instance(Device::class, $mockDeviceModel);

        $mockRFDeviceModel = Mockery::mock(RFDevice::class);
        $mockRFDeviceModel->shouldReceive('add')->withAnyArgs()->once();
        $this->app->instance(RFDevice::class, $mockRFDeviceModel);

        $mockUserDeviceModel = Mockery::mock(UserDevice::class);
        $mockUserDeviceModel->shouldReceive('add')->withAnyArgs()->once();
        $this->app->instance(UserDevice::class, $mockUserDeviceModel);

        $user = $this->givenSingleUserExists();

        $this->addDeviceForUser($user->user_id);
    }

    private function givenSingleUserExists()
    {
        $user = new User;

        $name = self::$faker->name();
        $email = self::$faker->email();
        $userId = self::$faker->uuid();

        return $user;
    }

    private function addDeviceForUser($userId)
    {
        $this->withSession([env('SESSION_USER_ID') => $userId])
            ->call('POST', '/devices/add', [
                'name' => 'Taylor',
                'description' => 'abcd',
                'onCode' => 1,
                'offCode' => 2,
                'pulseLength' => 3
            ]);
    }
}
