<?php

namespace App\Tests\MesTests;

use App\MesClasses\Hello;
use PHPUnit\Framework\TestCase;

class HelloTest extends TestCase
{
    public function testPrint_withoutName():void{
        $hello = new Hello();
        $expected = 'Hello World !';
        $result = $hello->print();
        $this->assertSame($expected, $result,"Le résultat est identique");
    }
    public function testPrint_withname():void{
        $hello = new Hello();
        $result = $hello->print('Thibault');
        $expected = 'Hello, Thibault !';
        $this->assertSame($expected, $result);
    }
}
