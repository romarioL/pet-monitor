<?php

namespace App;

use App\EstaLonge;
use App\IObservado;
use App\IPet;
use App\IDono;
use App\Sinalizador;
use App\DistanciaPetDono;
use App\ConfiguradorDistancia;

class Monitoria implements IObservado
{
    private $pet;
    private $dono;
    private $distancia;
    
    public function __construct(IPet $pet, IDono $dono, IConfiguradorDistancia $distancia)
    {
        $this->pet = $pet;
        $this->dono = $dono;
        $this->distancia = $distancia;
    }
    
    public function monitorarPetLonge()
    {
        $estaLonge = new EstaLonge(new DistanciaPetDono($this->pet, $this->dono), $this->distancia);
        if ($estaLonge->estaLonge() == true) {
            $sinalizador = new Sinalizador();
            return  $sinalizador->estaLonge($this->dono);
        }
    }
}
