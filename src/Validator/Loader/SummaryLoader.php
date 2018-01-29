<?php
/**
 * Created by PhpStorm.
 * User: Giansalex
 * Date: 18/07/2017
 * Time: 21:20.
 */

namespace Greenter\Validator\Loader;

use Greenter\Model\Summary\Summary;
use Greenter\Validator\LoaderMetadataInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class SummaryLoader implements LoaderMetadataInterface
{
    public function load(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraints('correlativo', [
            new Assert\NotBlank(),
            new Assert\Length(['max' => 5]),
        ]);
        $metadata->addPropertyConstraints('fecGeneracion', [
            new Assert\NotBlank(),
            new Assert\Date(),
        ]);
        $metadata->addPropertyConstraints('fecResumen', [
            new Assert\NotBlank(),
            new Assert\Date(),
        ]);
        $metadata->addPropertyConstraints('company', [
            new Assert\NotBlank(),
            new Assert\Valid(),
        ]);
        $metadata->addPropertyConstraints('details', [
            new Assert\NotBlank(),
            new Assert\Valid(),
        ]);
        $metadata->addConstraint(new Assert\Callback([$this, 'validate']));
    }

    public function validate($object, ExecutionContextInterface $context)
    {
        /**@var $object Summary */
        if ($object->getFecResumen() > new \DateTime()) {
            $context->buildViolation('2236')
                ->atPath('fecResumen')
                ->addViolation();
            return;
        }

        if ($object->getFecGeneracion() > $object->getFecResumen()) {
            $context->buildViolation('4036')
                ->atPath('fecGeneracion')
                ->addViolation();
        }
    }
}
