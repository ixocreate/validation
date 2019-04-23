<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Validation;

use Ixocreate\Validation\Violation\ViolationCollectorInterface;

interface ValidatableInterface
{
    public function validate(ViolationCollectorInterface $violationCollector): void;
}
