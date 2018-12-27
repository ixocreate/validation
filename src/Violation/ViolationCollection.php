<?php
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