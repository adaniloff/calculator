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
        $sum = 0;

        $this->setup($operation);

        

        return $sum;
    }

    /**
     * @param Operation $operation
     */
    private function setup(Operation $operation)
    {
        //  1 + 34 + 4 * 3 - 2 + 4
        preg_match_all(Operation::PATTERN, $operation->getValue(), $matches, PREG_UNMATCHED_AS_NULL);

        list($all, $multipliers, $additions) = $matches;
        $this->matches     = $all;
        $this->multipliers = array_filter($multipliers, function($value) { return $value; });
        $this->additions   = array_filter($additions, function($value) { return $value; });
    }
}
