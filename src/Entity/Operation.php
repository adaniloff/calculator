<?php
/** Namespace */
namespace App\Entity;

/**
 * Class Operation
 * @package App\Entity
 */
class Operation
{
    const PATTERN = "/([\*\/]+)|([\+\-]+)|(\d+)/";

    /**
     * @var string
     */
    private $value;

    /**
     * @return null|string
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param null|string $value
     * @return Operation
     */
    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }
}
