<?php
/**
 * @copyright Macintoshplus (c) 2019
 * Added by : Macintoshplus at 29/03/19 23:12
 */

namespace AppBundle\Configuration\Model;


use CCMBenchmark\Ting\Entity\NotifyProperty;
use CCMBenchmark\Ting\Entity\NotifyPropertyInterface;

class Config implements NotifyPropertyInterface
{
    use NotifyProperty;

    /**
     * @var string
     */
    private $cle;

    /**
     * @var string
     */
    private $valeur;

    /**
     * @param string $cle
     * @param string $valeur
     * @return Config
     */
    public static function init($cle, $valeur) {
        $obj = new self();
        $obj->cle = $cle;
        $obj->valeur = $valeur;
        return $obj;
    }

    /**
     * @return string
     */
    public function getCle()
    {
        return $this->cle;
    }

    /**
     * @return string
     */
    public function getValeur()
    {
        return $this->valeur;
    }
}
