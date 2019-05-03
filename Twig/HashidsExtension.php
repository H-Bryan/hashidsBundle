<?php

namespace cayetanosoriano\HashidsBundle\Twig;

use Hashids\Hashids;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Twig extension to allow encoding and decoding Hashids
 *
 * @author Jaik Dean <jaik@fluoresce.co>
 */
class HashidsExtension extends AbstractExtension
{
    /**
     * @var Hashids\Hashids;
     */
    private $hashids;

    public function __construct(Hashids $hashids)
    {
        $this->hashids = $hashids;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('hashid_encode', [$this, 'encode']),
            new TwigFilter('hashid_decode', [$this, 'decode']),
        ];
    }

    public function encode($number)
    {
        return $this->hashids->encode($number);
    }

    public function decode($hash)
    {
        return $this->hashids->decode($hash);
    }

    public function getName()
    {
        return 'hashids_extension';
    }
}
