<?php
/**
 * @copyright Macintoshplus (c) 2019
 * Added by : Macintoshplus at 29/03/19 23:09
 */

namespace AppBundle\Configuration\Repository;

use AppBundle\Configuration\Model\Config;
use CCMBenchmark\Ting\Repository\Metadata;
use CCMBenchmark\Ting\Repository\MetadataInitializer;
use CCMBenchmark\Ting\Repository\Repository;
use CCMBenchmark\Ting\Serializer\SerializerFactoryInterface;

class ConfigRepository extends Repository implements MetadataInitializer
{

    public function getToEdit() {

    }

    public static function initMetadata(SerializerFactoryInterface $serializerFactory, array $options = [])
    {
        $metadata = new Metadata($serializerFactory);

        $metadata->setEntity(Config::class);
        $metadata->setConnectionName('main');
        $metadata->setDatabase($options['database']);
        $metadata->setTable('afup_configuration');

        $metadata
            ->addField([
                'columnName' => 'cle',
                'fieldName' => 'cle',
                'primary'       => true,
                'autoincrement' => false,
                'type' => 'string'
            ])
            ->addField([
                'columnName' => 'valeur',
                'fieldName' => 'valeur',
                'type' => 'string'
            ])
        ;

        return $metadata;
    }

}
