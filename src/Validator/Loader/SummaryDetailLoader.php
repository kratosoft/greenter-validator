<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 18/07/2017
 * Time: 21:22
 */

namespace Greenter\Validator\Loader;

use Greenter\Validator\LoaderMetadataInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class SummaryDetailLoader implements LoaderMetadataInterface
{
    public function load(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints('tipoDoc', [
            new Assert\NotBlank(),
            new Assert\Choice([
                'choices' => ['03', '07', '08']
            ]),
        ]);
        $metadata->addPropertyConstraints('serieNro', [
            new Assert\NotBlank(),
            new Assert\Regex([
                'pattern' => '/^[B][A-Z0-9]{3}-[0-9]{1,8}$/',
                'message' => 'La serie no cumple el formato BXXX',
            ]),
        ]);
        $metadata->addPropertyConstraints('clienteTipo', [
            new Assert\Length(['max' => 1]),
        ]);
        $metadata->addPropertyConstraints('clienteNro', [
            new Assert\Length(['max' => 20]),
        ]);
        $metadata->addPropertyConstraints('estado', [
            new Assert\NotBlank(),
            new Assert\Length(['max' => 1]),
        ]);
        $metadata->addPropertyConstraint('docReferencia', new Assert\Valid());
        $metadata->addPropertyConstraint('total', new Assert\NotBlank());
        $metadata->addPropertyConstraint('mtoIGV', new Assert\NotBlank());
        $metadata->addPropertyConstraint('mtoISC', new Assert\NotBlank());
    }
}