<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Validation\Violation;

use Ixocreate\Validation\Violation\ViolationCollector;
use PHPUnit\Framework\TestCase;

class ViolationCollectorTest extends TestCase
{
    /**
     * @covers \Ixocreate\Validation\Violation\ViolationCollector::add
     * @covers \Ixocreate\Validation\Violation\ViolationCollector::violations
     */
    public function testViolation()
    {
        $violationCollector = new ViolationCollector();

        $violationCollector->add("name", "invalid.name", "Name is invalid");
        $violationCollector->add("name", "invalid.name");

        $violations = $violationCollector->violations();
        $this->assertCount(2, $violations);
        $this->assertSame("name", $violations[0]->name());
        $this->assertSame("invalid.name", $violations[1]->error());
        $this->assertSame("Name is invalid", $violations[0]->message());
        $this->assertNull($violations[1]->message());
    }
}
