<?php

namespace App\MesClasses;

class Produit
{
    public const ALIM = "alimentation";
    public const TVA_1 = 6 ;
    public const TVA_2 = 21;
    private string $nom;
    private string $typeArticle;
    private float $prixHtva;

    /**
     * @throws \Exception
     */
    public function __construct(string $nom="", string $type="", float $prixHtva=0.0)  {
        if (trim($nom) === ""){
            throw new \InvalidArgumentException("Le nom du produit est obligatoire");
        }
        if (strlen($nom) > 20){
            throw new \InvalidArgumentException("Le nom du produit est trop long");
        }
        if (trim($type)===""){
            throw new \InvalidArgumentException("Le type du produit est obligatoire");
        }
        if ($prixHtva < 0 ){
            throw new \InvalidArgumentException("Le prix du produit doit être positif");
        }
        if ($prixHtva === 0.0){
            throw new \InvalidArgumentException("Le prix doit être différent de zéro");
        }
        $this->nom = $nom;
        $this->typeArticle = $type;
        $this->prixHtva = $prixHtva;
    }

    /**
     * Calcule le prix tva comprise
     @return float|\Exception
     */
    public function calulerTvac():float | \Exception{
        if ($this->typeArticle === self::ALIM){
            return $this->prixHtva * (1 + (self::TVA_1/100));
        }
        return $this->prixHtva * (1 + (self::TVA_2/100)) ;
    }
    public function afficher():string{
        return "Nom article : " . $this->nom . PHP_EOL .
            " Type d'article : " . $this->typeArticle . PHP_EOL .
            " Prix Hors TVA : " . $this->prixHtva . PHP_EOL .
            " Prix TvaC : " . $this->calulerTvac();
    }
}
