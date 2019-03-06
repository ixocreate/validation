<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Validation\Violation;

use Ixocreate\Collection\AbstractCollection;
use Ixocreate\Collection\Collection;
use Ixocreate\Collection\Exception\InvalidType;

final class ViolationCollection extends AbstractCollection
{
    public function __construct($items = [])
    {
        $items = new Collection($items);

        /**
         * add type check
         */
        $items = $items->each(function ($value) {
            if (!($value instanceof Violation)) {
                throw new InvalidType('All items must be of type ' . Violation::class . '. Got item of type ' . \gettype($value));
            }
        });

        parent::__construct($items);
    }
}
