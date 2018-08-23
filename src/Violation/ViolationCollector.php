<?php
namespace KiwiSuite\Validation\Violation;

use KiwiSuite\Contract\Validation\ViolationCollectorInterface;

final class ViolationCollector implements ViolationCollectorInterface
{
    /**
     * @var array
     */
    private $violations = [];

    /**
     * @param string $name
     * @param string $error
     * @param string|null $message
     */
    public function add(string $name, string $error, string $message = null): void
    {
        $this->violations[] = new Violation($name, $error, $message);
    }

    /**
     * @return array
     */
    public function violations(): array
    {
        return $this->violations;
    }
}