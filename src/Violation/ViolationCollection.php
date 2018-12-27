<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Validation\Violation;

use Ixocreate\Entity\Collection\AbstractCollection;

final class ViolationCollection extends AbstractCollection
{
    public function __construct(array $items = [])
    {
        $items = \array_values($items);
        $items = (function (Violation ...$violation) {
            return $violation;
        })(...$items);

        parent::__construct($items);
    }
}
