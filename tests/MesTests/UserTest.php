<?php

namespace App\Tests\MesTests;

use App\Presentation\User;
use DateTime;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function testConstruct_ok():void{
        $user = new User('nomTest', 'emailTest', new \DateTime('now'), 'PhoneTest');
        $this->assertNotEmpty($user);
    }

    /**
     * @throws Exception
     */
    public function testConstruct_nameEmpty():void{
        $this->expectException(InvalidArgumentException::class);
        $user = new User('', 'emailTest', new \DateTime('now'), 'PhoneTest');
    }
    public function testSetNameNull():void{
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Name cannot be empty");
        $user = new User();
        $user->setName(null);
    }

    /**
     * @throws InvalidArgumentException|Exception
     */
    public function testBirthdate_1900():void{
        $user = new User("Pierre","pierre@cfwb.be", new DateTime('2024-01-01'), "02/800.10.31");
        $this->expectException(InvalidArgumentException::class);
        $user->setBirthdate(new DateTime('1899-01-01'));
    }

    /**
     * @throws InvalidArgumentException|Exception
     */
    public function testBirthdate_futur():void{
        $user = new User("Pierre","pierre@cfwb.be", new DateTime('2024-01-01'), "02/800.10.31");
        $this->expectException(InvalidArgumentException::class);
        $user->setBirthdate(new DateTime('2100-01-01'));
    }

}
