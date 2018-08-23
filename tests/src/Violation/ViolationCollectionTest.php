<?php
namespace KiwiSuiteTest\Validator\Violation;

use KiwiSuite\Validation\Violation\Violation;
use KiwiSuite\Validation\Violation\ViolationCollection;
use PHPUnit\Framework\TestCase;

class ViolationCollectionTest extends TestCase
{
    /**
     * @covers \KiwiSuite\Validation\Violation\ViolationCollection::__construct
     */
    public function testViolationCollection()
    {
        $violationCollection = new ViolationCollection([]);
        $this->assertCount(0, $violationCollection);

        $violationCollection = new ViolationCollection([
            'test' => new Violation("name", "invalid.name")
        ]);
        $this->assertCount(1, $violationCollection);
    }
}