<?php

namespace Legionofmyown\AngsymBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AngsymController extends Controller
{
    /**
     * @Route("/angsymform/{name}/{module}", name="angsym_getform")
     * @Template("AngsymBundle:AngForm:form.html.twig")
     * @param $name string
     * @param $module string
     * @return array
     */
    public function getFormAction($name, $module)
    {
        $this->get('twig')->addGlobal('angsym_module', $module);

        $parts = explode(':', $name);
        $parts[0] = '\\' . $parts[0] . '\\Form';

        $name = join('\\', $parts);

        $form = $this->createForm(new $name());

        return [
            'form' => $form->createView(),
        ];
    }
}
