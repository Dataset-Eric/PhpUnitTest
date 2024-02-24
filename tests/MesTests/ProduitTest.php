<?php

namespace App\Tests\MesTests;
use App\MesClasses\Produit;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertSame;

/**
 * Enoncé :
 * Créer une classe Produit qui contient un nom, un type (alimentaire ou pas), et un prix hors tva
 * Créer une méthode qui calcule le prix tva comprise en fonction du type du produit (alimentaire = 6% sinon 21%)
 * Créer une méthode qui affiche le détail du produit
 *
 * Scénario 1 :
 *   1. Etant donné un Produit alimentaire correctement défini,
 *   2. Quand  le produit a un prix Htva de 100€
 *   3. Alors on calcule le prix de tva compris
 *   4. Et on affiche le prix tva compris de 106€
 *
 * Scénario 2 :
 *   1. Etant donné un produit non alimentaire correctement défini
 *   2. Quand le produit a un prix hTva de 100€
 *   3. Alors on calcule le prix de tva compris
 *   4. Et on affiche : "le prix tva compris de 121€"
 *
 * Scénario 3 :
 *   1. Etant donné un Produit qui n'a pas de nom
 *   2. Quand on instancie le produit
 *   3. Alors on doit générer une erreur
 *   4. Et afficher : "Le nom du produit est obligatoire"
 *
 * Scénario 4 :
 *   1. Etant donné un produit qui n'a pas de type
 *   2. Quand on instancie le produit
 *   3. Alors on doit générer une erreur
 *   4. Et afficher : "Le type du produit est obligatoire"
 *
 * Scénario 5 : le prix est négatif
 *   1. Etant donné un produit qui a un prix négatif
 *   2. Quand on instancie le produit
 *   3. Alors on doit générer une erreur
 *   4. Et afficher : "Le prix du produit doit être positif"
 *
 * Scénario 6 : le prix doit être différent de zéro
 *   1. Etant donné un produit aui a un prix égal à zéro
 *   2. Quand on instancie le produit
 *   3. Alors on doit générer une erreur
 *   4. Et afficher : "Le prix doit être supérieur à zéro"
 *
 * Scénario 7 : Le nom du produit ne peut pas être vide
 *   1. Etant donné un nom de produit qui a des espaces dans le nom
 *   2. Quand on instancie le produit
 *   3. Alors on doit générer une erreur
 *   4. Et afficher : "Le nom du produit est obligatoire"
 *
 * Scénario 8 : Le nom du type de produit ne peut pas être vide
 *   1. Etant donné un type de produit qui a des espaces dans le nom
 *   2. Quand on instancie le produit
 *   3. Alors on doit générer une erreur
 *   4. Et afficher : "Le type du produit est obligatoire"
 *
 * Scénario 9 : Le nom du produit ne peut pas dépasser 20 caractères
 *   1. Etant donné un nom de produit supérieur à 20 caractères
 *   2. Quand on instancie le produit
 *   3. Alors on doit générer une erreur
 *   4. Et afficher : "Le nom du produit est trop long"
 */
class ProduitTest extends TestCase
{
    private static float $prixHtva;
    private string $type;

    /**
     * setUp est exécuté au début de chaque test
     * @return void
     */
    public static function setUpBeforeClass():void{
        self::$prixHtva = 100.00;
    }
    public function setUp():void{
        $this->type="alimentation";
    }
    /**
     * Calcule le prix tvac d'un produit alimentaire avec un nom, un type et un prix correct
     * @return void
     * @throws \Exception
     */
    public function testCalculerTvac_Alim(): void{
        $monProduit = new Produit("pomme", "alimentation", self::$prixHtva);
        $attendu = 106.0 ;
        $resultat = $monProduit->calulerTvac();
        $this->assertSame($attendu, $resultat);
    }

    /**
     * Calcule le prix tvac d'un produit non alimentaire avec un nom, un type et un prix correct
     * @return void
     * @throws \Exception
     */
    public function testCalculerTvac_NonAlim():void{
        $monProduit = new Produit("Savon","soin",self::$prixHtva);
        $attendu = 121.0;
        $resultat = $monProduit->calulerTvac();
        assertSame($attendu,$resultat);
    }
    public function testConstruct_NomObligatoire():void{
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage("Le nom du produit est obligatoire");
        $monProduit = new Produit("", "alimentaire", self::$prixHtva);
    }


    /**
     * @throws \Exception
     */
    public function testConstruct_NomEspace():void{
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage("Le nom du produit est obligatoire");
        $monProduit = new Produit("      ","alimentation", self::$prixHtva);
    }

    /**
     * @throws \Exception
     */
    public function testConstruct_NomTropLong():void{
        $this->expectException("InvalidArgumentException");
        $this->expectExceptionMessage("Le nom du produit est trop long");
        $monProduit = new Produit("Mon produit a un nom vraiment long","alimentation", self::$prixHtva);
    }

    /**
     * @throws \Exception
     */
    public function testConstruct_TypeObligatoire():void{
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage("Le type du produit est obligatoire");
        $monProduit = new Produit("Savon", "", self::$prixHtva);
    }

    /**
     * @throws \Exception
     */
    public function testConstruct_PrixDiffZero():void{
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage("Le prix doit être différent de zéro");
        $monProduit = new Produit("Savon", "soin", 0);
    }

    /**
     * @throws \Exception
     */
    public function testConstruct_PrixNegatif():void{
        $this->expectException('InvalidArgumentException');
        $this->expectExceptionMessage("Le prix du produit doit être positif");
        $monProduit = new Produit("Savon", "soin", -1);
    }
    public function testAfficher_savon():void{
        $monProduit = new Produit("Savon", "soin", self::$prixHtva);
        $attendu =  "Nom article : Savon" . PHP_EOL .
                    " Type d'article : soin" . PHP_EOL .
                    " Prix Hors TVA : 100" . PHP_EOL .
                    " Prix TvaC : 121";
        $resultat = $monProduit->afficher();
        $this->assertSame($attendu, $resultat);
    }
    public function tearDown(): void
    {
        $this->type='';
    }

    /**
     * tearDown est exécuté à la fin de chaque test pour réinitialiser les ressources utilisées par le test
     * @return void
     */
    public static function tearDownAfterClass(): void
    {
        self::$prixHtva = 0;
    }
}
