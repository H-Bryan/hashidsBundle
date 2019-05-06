<?php

namespace cayetanosoriano\HashidsBundle\Request\ParamConverter;

use Hashids\HashidsInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\DoctrineParamConverter;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class HashidsDoctrineParamConverter extends DoctrineParamConverter
{
    /**
     * @var Hashids\HashidsInterface
     */
    protected $hashids;

    public function __construct(ManagerRegistry $registry = null, ExpressionLanguage $expressionLanguage = null, HashidsInterface $hashids, array $options = [])
    {
        $this->hashids = $hashids;
        parent::__construct($registry);
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        try {
            return parent::apply($request, $configuration);
        } catch (\Exception $e) {
            if ($request->attributes->has('hashid')) {
                $request->attributes->set(
                    $configuration->getName(),
                    $this->hashids->decode($request->attributes->get('hashid'))[0]
                );

                return parent::apply($request, $configuration);
            }
        }

        return false;
    }
}
