<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Validation;

use Ixocreate\Validation\Violation\ViolationCollector;

final class Validator
{
    /**
     * @param $value
     * @return bool
     */
    public function supports($value): bool
    {
        if ($value instanceof ValidatableInterface) {
            return true;
        }

        return false;
    }

    /**
     * @param $value
     * @throws \Exception
     * @return Result
     */
    public function validate($value): Result
    {
        if (!$this->supports($value)) {
            //TODO Exception
            throw new \Exception("Can't validate value");
        }

        $violationCollector = new ViolationCollector();

        if ($value instanceof ValidatableInterface) {
            $value->validate($violationCollector);
        }

        return new Result($violationCollector);
    }
}
