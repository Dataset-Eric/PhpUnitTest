<?php declare(strict_types=1);

namespace App\Tests\MesTests;

use App\MesClasses\Operation;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class OperationTest extends TestCase
{
    /**
     *
     * @throws \Exception
     */
    public function testDiv_Ok(): void{
        // Arrangement
        $operation = new Operation(9.0, 3.0);

        //Exécution
        $resultat = $operation->div();
        $expected = 3.0;

        //Comparaison
        $this->assertSame($expected, $resultat);
    }

    /**
     * Provoque une exception et arrête le programme de tests
     *
     */
    public function testDiv_pasOk():void{
        // Arrangement
        $operation = new Operation(9.0, 0.0);

        $this->markTestSkipped('Ce test génère une exception avant la fin du test et arrêt le programme de tests');

        //Exécution
        $resultat = $operation->div();
        $expected = 0.0;

        //Comparaison
        $this->assertSame($expected, $resultat);

    }
    /**
     * @throws \Exception
     */
    public function testDiv_ByZero(): void{
        $operation = new Operation(9.0,0);
        $this->expectException('DivisionByZeroError');
        $operation->div();
    }

    /**
     * Le test va prendre les données de la fonction additionProvider et va vérifier l'addition
     * @param float $a chiffre 1 provenant du fournisseur de données
     * @param float $b chiffre 2 provenant du fournisseur de données
     * @param float $expected Résultat attendu (addition de $a et $b)
     * @return void
     */
    #[dataProvider('additionProvider')]
    public function testAdd_datas(float $a, float $b, float $expected):void{
        $operation = new Operation($a,$b);
        $resultat = $operation->add();
        $this->assertSame($expected, $resultat);
    }

    /**
     * Fournisseur de données
     * Clé : nom du test
     * Element 1 : chiffre 1
     * Element 2 : chiffre 2
     * Element 3 : Résultat = chiffre 1 + chiffre 2
     * Le dernier test est faux
     * @return \int[][]
     *
     */
    public static function additionProvider():array{
        return [
            'addition zero'=>[0,0,0],
            'zero + un'=>[0,1,1],
            'un + zero'=>[1,0,1],
            'un + un'=>[1,1,0]
            ];
    }
}
