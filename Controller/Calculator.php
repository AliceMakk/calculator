<?php
include(__DIR__ . "/../Model/TwoNumbers.php");

/**
 * The class manipulates with passed figures
 *
 * User: Alice
 * Date: 15/07/16
 * Time: 2:15 PM
 */
class Calculator
{

    private $arithFunctions = array(
        "+" => "adding",
        "&minus;" => "subtraction",
        "&times;" => "multiplying",
        "&divide;" => "dividing");

    const SCALE = 10;
    const CHARSET = "UTF-8";

    private $leftOperand;
    private $rightOperand;

    private $result;
    private $error = NULL;

    /**
     * Calculate constructor, assigns operands into the model class
     *
     * @param $fNum
     * @param $sNum
     */
    public function __construct($fNum, $sNum, $arith)
    {
        $argsObject = new TwoNumbers();

        $argsObject->setFirstNumber($fNum);

        $arith = htmlentities($arith, ENT_QUOTES, self::CHARSET);
        $argsObject->setArithFunc($arith, $this->arithFunctions);

        $argsObject->setSecondNumber($sNum);

        if (!is_null($er = $argsObject->getError())) $this->error = $er;

        else {
            $this->leftOperand = $argsObject->getFirstNumber();
            $this->rightOperand = $argsObject->getSecondNumber();

            $this->callArithMethod($argsObject->getArithFunc());
        }
    }

    /**
     * Get result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->setResult();
    }

    /**
     * Set result
     *
     * @return string
     */
    private function setResult()
    {
        if (!is_null($this->error)) return json_encode(array("error" => $this->error));

        return $this->result;
    }

    /**
     * Calling the chosen method from ARITH_FUNCTION
     */
    private function callArithMethod($func)
    {
        $this->$func();
    }

    /**
     * Multiplying two numbers
     */
    private function multiplying()
    {
        $this->result = bcmul($this->leftOperand, $this->rightOperand);
    }

    /**
     * Subtracting two numbers
     */
    private function subtraction()
    {
        $this->result = bcsub($this->leftOperand, $this->rightOperand);
    }

    /**
     * Adding two numbers
     */
    private function adding()
    {
        $this->result = bcadd($this->leftOperand, $this->rightOperand);
    }

    /**
     * Dividing two numbers
     */
    private function dividing()
    {
        if (!(boolean)$this->rightOperand) {
            $this->error = 'Division by zero';
        } else {
            $this->result = bcdiv($this->leftOperand, $this->rightOperand, self::SCALE);
        }
    }
}
