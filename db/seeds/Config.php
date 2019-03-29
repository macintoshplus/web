<?php
/**
 * @copyright Macintoshplus (c) 2019
 * Added by : Macintoshplus at 29/03/19 21:39
 */

use Phinx\Seed\AbstractSeed;

class Config extends AbstractSeed
{
    public function run()
    {
        $adress = <<<ADDRESS
32, Boulevard de Strasbourg
CS 30108
ADDRESS;

        $data = [
            [
                'cle' => 'afup_raison_sociale',
                'valeur' => 'AFUP',
            ],
            [
                'cle' => 'afup_adresse',
                'valeur' => $adress,
            ],
            [
                'cle' => 'afup_code_postal',
                'valeur' => '75468',
            ],
            [
                'cle' => 'afup_ville',
                'valeur' => 'Paris Cedex 10',
            ],
            [
                'cle' => 'afup_email',
                'valeur' => 'bureau@afup.org',
            ],
            [
                'cle' => 'afup_siret',
                'valeur' => '500 869 011 00014',
            ],
            [
                'cle' => 'rib_etablissement',
                'valeur' => '17515',
            ],
            [
                'cle' => 'rib_guichet',
                'valeur' => '90000',
            ],
            [
                'cle' => 'rib_compte',
                'valeur' => '04045168667',
            ],
            [
                'cle' => 'rib_cle',
                'valeur' => '70',
            ],
            [
                'cle' => 'rib_domiciliation',
                'valeur' => 'CE ILE DE FRANCE PARIS',
            ],
            [
                'cle' => 'rib_bic',
                'valeur' => 'CEPAFRPP751',
            ],
            [
                'cle' => 'rib_iban',
                'valeur' => 'FR76 1751 5900 0004 0451 6866 770',
            ],
            [
                'cle' => 'bureau_0',
                'valeur' => 'MaximeTeneur',
            ],
            [
                'cle' => 'bureau_1',
                'valeur' => 'JacquesBodinHullin',
            ],
            [
                'cle' => 'bureau_2',
                'valeur' => 'ThierryMarianne',
            ],
            [
                'cle' => 'bureau_3',
                'valeur' => 'paxal',
            ],
            [
                'cle' => 'bureau_4',
                'valeur' => 'ChristopheVilleneuve',
            ],
            [
                'cle' => 'bureau_5',
                'valeur' => 'LaurenceHoizey',
            ],
        ];
        $table = $this->table('afup_configuration');
        $table->truncate();
        $table
            ->insert($data)
            ->save();
    }

}
