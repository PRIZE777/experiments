<?php

namespace CompilerBundle\Model;

class Token {

    protected $id;
    protected $value;
    protected $tag;

    /**
     * Constructor
     */
    public function __construct() {
        $this->id = NULL;
        $this->value = NULL;
        $this->tag = NULL;
    }

    function next_token($tokens, $expression) {
        $exp_mass = str_split($expression, 1);
        /*
          if (strlen($expression) > 1 && $exp_mass[0] == '!' && $exp_mass[1] == '=') {
          $this->value = '!=';
          $this->tag = 'RESERVED';
          $tokens[] = $this;
          $expression = substr($expression, 2);
          return $expression;
          }
          if (strlen($expression) > 1 && $exp_mass[0] == '<' && $exp_mass[1] == '=') {
          $this->value = '<=';
          $this->tag = 'RESERVED';
          $tokens[] = $this;
          $expression = substr($expression, 2);
          return $expression;
          }
          if (strlen($expression) > 1 && $exp_mass[0] == '>' && $exp_mass[1] == '=') {
          $this->value = '>=';
          $this->tag = 'RESERVED';
          $tokens[] = $this;
          $expression = substr($expression, 2);
          return $expression;
          }

         */
        if (preg_match('/[!*+-\/(){}><=;]/', $exp_mass[0])) {
            $this->value = $exp_mass[0];
            $this->tag = 'RESERVED';
            $tokens[] = $this;
            $expression = substr($expression, 1);
            return $expression;
        }

        if (preg_match('/[0-9]+/', $expression)) {
            $count = 0;
            foreach ($exp_mass as $value) {
                if ($value >= '0' && $value <= '9') {
                    $count++;
                }
            }

            $this->value = substr($expression, 0, $count);
            $this->tag = 'INT';
            $tokens[] = $this;
            $expression = substr($expression, $count);
            return $expression;
        }
        return false;
    }

    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function getValue() {
        return $this->value;
    }

    function getTag() {
        return $this->tag;
    }

    function setValue($value) {
        $this->value = $value;
    }

    function setTag($tag) {
        $this->tag = $tag;
    }

}
