<?php

namespace Legionofmyown\AngsymBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class AngsymController extends Controller
{
    /**
     * @Route("/angsymform/{module}/{form}", name="angsym_getform")
     * @Template("AngsymBundle:AngForm:form.html.twig")
     * @param $request Request
     * @param $module string
     * @param $form string
     * @return array
     */
    public function getFormAction(Request $request, $module, $form)
    {
        $action = $request->get('action', '');
        $method = $request->get('method', 'POST');

        $this->get('twig')->addGlobal('angsym_module', $module);
        $this->get('twig')->addGlobal('angsym_action', $action);
        $this->get('twig')->addGlobal('angsym_method', $method);

        return [
            'form' => $this->createForm(new $form())->createView(),
        ];
    }

}
