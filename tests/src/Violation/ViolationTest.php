<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace IxocreateTest\Validator\Violation;

use Ixocreate\Validation\Violation\Violation;
use PHPUnit\Framework\TestCase;

class ViolationTest extends TestCase
{
    /**
     * @covers \Ixocreate\Validation\Violation\Violation::__construct
     * @covers \Ixocreate\Validation\Violation\Violation::name
     * @covers \Ixocreate\Validation\Violation\Violation::message
     * @covers \Ixocreate\Validation\Violation\Violation::error
     * @covers \Ixocreate\Validation\Violation\Violation::jsonSerialize
     */
    public function testViolationCollection()
    {
        $violation = new Violation("name", "error", "message");
        $this->assertSame("name", $violation->name());
        $this->assertSame("error", $violation->error());
        $this->assertSame("message", $violation->message());
        $this->assertSame([
            'error' => 'error',
            'message' => 'message',
        ], $violation->jsonSerialize());

        $violation = new Violation("name", "error");
        $this->assertNull($violation->message());
        $this->assertSame([
            'error' => 'error',
            'message' => null,
        ], $violation->jsonSerialize());
    }

    /**
     * @covers \Ixocreate\Validation\Violation\Violation::__construct
     * @covers \Ixocreate\Validation\Violation\Violation::offsetExists
     */
    public function testOffsetExists()
    {
        $violation = new Violation("name", "error", "message");

        $this->assertTrue($violation->offsetExists("name"));
        $this->assertTrue($violation->offsetExists("error"));
        $this->assertTrue($violation->offsetExists("message"));
        $this->assertFalse($violation->offsetExists("something_else"));
    }

    /**
     * @covers \Ixocreate\Validation\Violation\Violation::__construct
     * @covers \Ixocreate\Validation\Violation\Violation::offsetGet
     */
    public function testOffsetGet()
    {
        $violation = new Violation("name", "error", "message");

        $this->assertSame("name", $violation->offsetGet("name"));
        $this->assertSame("error", $violation->offsetGet("error"));
        $this->assertSame("message", $violation->offsetGet("message"));

        $this->expectException(\Exception::class);
        $violation->offsetGet("something_else");
    }

    /**
     * @covers \Ixocreate\Validation\Violation\Violation::__construct
     * @covers \Ixocreate\Validation\Violation\Violation::offsetSet
     */
    public function testOffsetSet()
    {
        $violation = new Violation("name", "error", "message");

        $this->expectException(\Exception::class);
        $violation->offsetSet("something_else", "string");
    }

    /**
     * @covers \Ixocreate\Validation\Violation\Violation::__construct
     * @covers \Ixocreate\Validation\Violation\Violation::offsetUnset
     */
    public function testOffsetUnset()
    {
        $violation = new Violation("name", "error", "message");

        $this->expectException(\Exception::class);
        $violation->offsetUnset("something_else", "string");
    }
}
