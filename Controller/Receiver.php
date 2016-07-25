<?php
include("Calculator.php");

/**
 * Class Receiver gets operands and arithmetic symbol
 */
class Receiver
{
    public $result;

    /**
     * Pass arguments to the Calculator
     *
     * @param $fNum
     * @param $sNum
     * @param $arith
     */
    public function sendArgs($fNum, $sNum, $arith){

        $res = new Calculator($fNum, $sNum, $arith);
        $this->result = $res->getResult();

    }

}

$firstNum  = isset($_POST['first_num']) ? $_POST['first_num'] : null;
$secondNum = isset($_POST['second_num']) ? $_POST['second_num'] : null;
$arith     = isset($_POST['arith']) ? $_POST['arith'] : null;

$recObj = new Receiver();
$recObj->sendArgs($firstNum,$secondNum,$arith);
echo $recObj->result;