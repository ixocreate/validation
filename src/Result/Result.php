<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Validation\Result;

use Ixocreate\Validation\Violation\Violation;
use Ixocreate\Validation\Violation\ViolationCollection;
use Ixocreate\Validation\Violation\ViolationCollector;

final class Result implements ResultInterface
{
    /**
     * @var ViolationCollection
     */
    private $violations;

    /**
     * @param ViolationCollector $violationCollector
     */
    public function __construct(ViolationCollector $violationCollector)
    {
        $this->violations = new ViolationCollection($violationCollector->violations());
    }

    /**
     * @return bool
     */
    public function isSuccessful(): bool
    {
        return $this->violations->count() === 0;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return $this->get($name)->count() > 0;
    }

    /**
     * @param string $name
     * @return ViolationCollection
     */
    public function get(string $name): \Traversable
    {
        return $this->violations->filter(function (Violation $violation) use ($name) {
            return $violation->name() === $name;
        });
    }

    /**
     * @return ViolationCollection
     */
    public function all(): \Traversable
    {
        return $this->violations;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $result = [];

        /** @var Violation $violation */
        foreach ($this->violations as $violation) {
            if (!\array_key_exists($violation->name(), $result)) {
                $result[$violation->name()] = [];
            }

            $result[$violation->name()][] = $violation;
        }

        return $result;
    }
}
