<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace IxocreateTest\Validator\Violation;

use Ixocreate\Validation\Violation\Violation;
use Ixocreate\Validation\Violation\ViolationCollection;
use PHPUnit\Framework\TestCase;

class ViolationCollectionTest extends TestCase
{
    /**
     * @covers \Ixocreate\Validation\Violation\ViolationCollection::__construct
     */
    public function testViolationCollection()
    {
        $violationCollection = new ViolationCollection([]);
        $this->assertCount(0, $violationCollection);

        $violationCollection = new ViolationCollection([
            'test' => new Violation("name", "invalid.name"),
        ]);
        $this->assertCount(1, $violationCollection);
    }
}
