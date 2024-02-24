<?php declare(strict_types=1);
namespace App\MesClasses ;
final class Hello
{
    public function print(string $name=""): string
    {
        if (!empty($name)) {
            return "Hello, {$name} !";
        }
        return "Hello World !";
    }
}

