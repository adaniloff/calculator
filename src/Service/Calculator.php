<?php
/** Namespace */
namespace App\Service;

/** Usages */
use App\Entity\Operation;

/**
 * Class Calculator
 * @package App\Service
 */
class Calculator
{
    private $matches;
    private $multipliers;
    private $additions;

    /**
     * @param Operation $operation
     * @return int
     */
    public function calculate(Operation $operation)
    {
        $this->setup($operation);

        $matches = $this->matches;

        foreach (array_reverse($this->multipliers, true) as $key => $multiplier) {
            switch ($multiplier) {
                case '/':
                    $value = $matches[$key-1] / $matches[$key+1];
                    break;
                default:
                    $value = $matches[$key-1] * $matches[$key+1];
            }
            $matches[$key-1] = 0;
            $matches[$key+1] = 0;
            $matches[$key] = $value;
        }

        foreach (array_reverse($this->additions, true) as $key => $addition) {
            switch ($addition) {
                case '-':
                    $value = $matches[$key-1] - $matches[$key+1];
                    break;
                default:
                    $value = $matches[$key-1] + $matches[$key+1];
            }
            $matches[$key-1] = 0;
            $matches[$key+1] = 0;
            $matches[$key] = $value;
        }

//        var_dump($matches);

        return array_sum($matches);
    }

    /**
     * @param Operation $operation
     */
    private function setup(Operation $operation)
    {
        //  1 + 34 + (4 * 3) - 2 + 4
        preg_match_all(Operation::PATTERN, $operation->getValue(), $matches, PREG_UNMATCHED_AS_NULL);

        list($all, $multipliers, $additions) = $matches;
        $this->matches     = $all;
        $this->multipliers = array_filter($multipliers, function($value) { return $value; });
        $this->additions   = array_filter($additions, function($value) { return $value; });
    }
}
