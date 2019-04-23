<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Validation\Violation;

interface ViolationCollectorInterface
{
    public function add(string $name, string $error, string $message = null): void;
}
