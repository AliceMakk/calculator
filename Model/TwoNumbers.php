<?php
/**
 * The class contains information about first and second operands,
 * depends on the clicked arithmetic button sets name of needed function
 * for further manipulation with the arguments
 *
 * User: Alice
 * Date: 15/07/16
 * Time: 1:00 PM
 */
class TwoNumbers
{

    /**
     * @var string $arithFunc
     */
    private $arithFunc;

    /**
     * @var int $firstNumber
     */
    private $firstNumber;

    /**
     * @var int $secondNumber
     */
    private $secondNumber;

    /**
     * @var array $error
     */
    private $error = array();

    /**
     * Set arithFunc
     *
     * @param string $key
     */
    public function setArithFunc($key,$arithFunction)
    {

        if(array_key_exists($key,$arithFunction))
        {
            $this->arithFunc = $arithFunction[$key];
        }

        elseif (empty($key))
        {
            $this->setError("An arithmetic symbol is not set");
        }

        else $this->setError("The arithmetic symbol <b>{$key}</b> doesn't exist");

    }

    /**
     * Get arithFunc
     *
     * @return string
     */
    public function getArithFunc()
    {
        return $this->arithFunc;
    }

    /**
     * Set firstNumber
     *
     * @param int $num
     */
    public function setFirstNumber($num)
    {
        $this->firstNumber = $this->validateNumber("first",$num);
    }

    /**
     * Get firstNumber
     *
     * @return int
     */
    public function getFirstNumber()
    {
        return $this->firstNumber;
    }

    /**
     * Set secondNumber
     *
     * @param int $num
     */
    public function setSecondNumber($num)
    {
        $this->secondNumber = $this->validateNumber("second",$num);
    }

    /**
     * Get secondNumber
     *
     * @return int
     */
    public function getSecondNumber()
    {
        return $this->secondNumber;
    }

    /**
     * Set error
     *
     * @param string $msg
     */
    private function setError($msg)
    {
        $this->error[] = $msg;
    }

    /**
     * Get error
     *
     * @return array|null
     */
    public function getError()
    {
        if(count($this->error) > 0)
        {
            return implode("<br/>",$this->error);
        }

        return NULL;
    }

    /**
     * Validate entered number
     *
     * @param $num
     * @return int
     */
    private function validateNumber($arg,$num)
    {
        if(!is_numeric($num))
        {
            $this->setError("The {$arg} argument is not set");
            return 0;
        }

        return $num;
    }
}