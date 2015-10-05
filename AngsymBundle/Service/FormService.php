<?php

namespace Legionofmyown\AngsymBundle\Service;

use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FormService {

    /** @var FormFactory  */
    private $factory;

    public function __construct(FormFactory $factory) {
        $this->factory = $factory;
    }

    /**
     * @param Request $request
     * @param string $formClass
     * @param string $entityClass
     * @return array
     */
    public function processForm(Request $request, $formClass, $entityClass)
    {
        $form = $this->factory->create(new $formClass(), new $entityClass());

        $arr = json_decode($request->getContent(), true);
        $parsed = [];
        parse_str(http_build_query($arr), $parsed);

        $request->attributes->add($parsed);
        $request->request->add($parsed);

        $form->handleRequest($request);

        $errors = [];
        foreach($form->getErrors(true, true) as $err) {
            $errors[$form->getConfig()->getName() . '_' . $err->getOrigin()->getConfig()->getName()][] = $err->getMessage();
        }

        return new JsonResponse([
            'valid' => $form->isValid(),
            'errors' => $errors,
        ]);

    }

}