<?php

namespace Legionofmyown\AngsymBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class AngsymController extends Controller
{
    /**
     * @Route("/angsymform/{name}/{module}", name="angsym_getform")
     * @Template("AngsymBundle:AngForm:form.html.twig")
     * @param $name string
     * @param $module string
     * @return array
     */
    public function getFormAction(Request $request, $name, $module)
    {
        $action = $request->get('action', '');
        $method = $request->get('method', 'POST');

        $this->get('twig')->addGlobal('angsym_module', $module);
        $this->get('twig')->addGlobal('angsym_action', $action);
        $this->get('twig')->addGlobal('angsym_method', $method);

        $parts = explode(':', $name);
        $parts[0] = '\\' . $parts[0] . '\\Form';

        $name = join('\\', $parts);

        $form = $this->createForm($f = new $name());

        return [
            'form' => $form->createView(),
        ];
    }
}
