<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Validation\Result;

interface ResultInterface extends \JsonSerializable
{
    public function isSuccessful(): bool;

    public function has(string $name): bool;

    public function get(string $name): \Traversable;

    public function all(): \Traversable;
}
