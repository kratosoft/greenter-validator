<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 16/12/2017
 * Time: 11:19 AM
 */

namespace Greenter\Validator\Loader;

use Greenter\Validator\LoaderMetadataInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class ItemAttributeValidator implements LoaderMetadataInterface
{
    /**
     * @param ClassMetadata $metadata .
     */
    public function load(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('code', new Assert\Length(['max' => 4]));
        $metadata->addPropertyConstraint('name', new Assert\Length(['max' => 100]));
        $metadata->addPropertyConstraint('value', new Assert\Length(['max' => 100]));
        $metadata->addPropertyConstraint('fecInicio', new Assert\Date());
        $metadata->addPropertyConstraint('fecFin', new Assert\Date());
    }
}