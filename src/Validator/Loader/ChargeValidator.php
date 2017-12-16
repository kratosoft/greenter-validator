<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 16/12/2017
 * Time: 11:16 AM
 */

namespace Greenter\Validator\Loader;

use Greenter\Validator\LoaderMetadataInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class ChargeValidator implements LoaderMetadataInterface
{
    /**
     * @param ClassMetadata $metadata .
     */
    public function load(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints('code', [
            new Assert\NotBlank(),
            new Assert\Length(['min' => 2, 'max' => 2]),
        ]);
        $metadata->addPropertyConstraints('mto', [
            new Assert\NotBlank(),
            new Assert\Type(['type' => 'numeric'])
        ]);
    }
}