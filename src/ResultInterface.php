<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Validation;

interface ResultInterface extends \JsonSerializable
{
    public function isSuccessful(): bool;

    public function has(string $name): bool;

    public function get(string $name): \Traversable;

    public function all(): \Traversable;
}
