<?php

namespace CompilerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use CompilerBundle\Model\Token;

class AjaxController extends Controller {

    public function lexerGetDataAction(Request $request) {
        if ($request->isMethod('POST')) {

            $expression = $request->get('expression');

            $tokens = new ArrayCollection();


            $count = 0;
            while (strlen($expression) != 0) {
                $token = new Token();
                $token->setId(++$count);
                $expression = $token->next_token($tokens, $expression);
            }

            return $this->render('CompilerBundle:ajax:lexer.html.twig', ['tokens' => $tokens]);
        }
    }

}
