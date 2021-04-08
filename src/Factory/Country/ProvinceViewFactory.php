<?php

declare(strict_types=1);

namespace Sylius\ShopApiPlugin\Factory\Country;

use Sylius\Component\Addressing\Model\ProvinceInterface;
use Sylius\ShopApiPlugin\View\Country\ProvinceView;

final class ProvinceViewFactory implements ProvinceViewFactoryInterface
{
    /** @var string */
    private $provinceViewClass;

    public function __construct(string $provinceViewClass)
    {
        $this->provinceViewClass = $provinceViewClass;
    }

    public function create(ProvinceInterface $province): ProvinceView
    {
        /** @var ProvinceView $provinceView */
        $provinceView = new $this->provinceViewClass();

        $provinceView->code = $province->getCode();
        $provinceView->name = $province->getName();
        $provinceView->abbreviation = $province->getAbbreviation();

        return $provinceView;
    }
}
