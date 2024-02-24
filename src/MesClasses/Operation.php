<?php
namespace App\MesClasses;
class Operation{
    private float $nombre1;
    private float $nombre2;
    public function __construct(float $nombre1, float $nombre2){
        $this->nombre1 = $nombre1;
        $this->nombre2 = $nombre2;
    }
    public function add()
    {
        return $this->nombre1 + $this->nombre2;
    }

    public function div():float{
         return $this->nombre1/$this->nombre2;
    }
}

