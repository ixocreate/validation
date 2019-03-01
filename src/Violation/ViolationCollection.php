<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Validation\Violation;

use Ixocreate\Collection\AbstractCollection;

final class ViolationCollection extends AbstractCollection
{
    public function __construct(array $items = [])
    {
        parent::__construct(
            (function (Violation ...$violation) {
                return $violation;
            })(...$items)
        );
    }
}
