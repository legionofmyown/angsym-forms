<?php

namespace Legionofmyown\AngsymBundle\Service;

use Symfony\Bridge\Twig\Extension\HttpKernelExtension;

class TwigExtension extends \Twig_Extension
{
    /** @var $kernelExtension HttpKernelExtension  */
    private $kernelExtension;

    public function __construct(HttpKernelExtension $kernelExtension) {
        $this->kernelExtension = $kernelExtension;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('angsym_form', [$this, 'renderForm'], ['is_safe' => ['html']]),
        ];
    }

    public function renderForm($module, $form, $action, $method = 'POST')
    {
        $ctrl = $this->kernelExtension->controller('AngsymBundle:Angsym:getForm', [
            'module' => $module,
            'form' => $form,
            'action' => $action,
            'method' => $method,
        ]);
        $ret = $this->kernelExtension->renderFragment($ctrl);

        return $ret;
    }

    public function getName()
    {
        return 'angsym_twig_extension';
    }
}