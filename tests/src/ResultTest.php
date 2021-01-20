<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Validation;

use Ixocreate\Validation\Result\Result;
use Ixocreate\Validation\Violation\ViolationCollector;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    /**
     * @var ViolationCollector
     */
    private $violationCollector;

    /**
     * @var ViolationCollector
     */
    private $emptyViolationCollector;

    public function setUp(): void
    {
        $this->emptyViolationCollector = new ViolationCollector();

        $this->violationCollector = new ViolationCollector();
        $this->violationCollector->add("name", "invalid.name", "Name is invalid");
        $this->violationCollector->add("email", "invalid.email", "Email is invalid");
        $this->violationCollector->add("email", "not.an.email");
    }

    /**
     * @covers \Ixocreate\Validation\Result\Result::isSuccessful
     * @covers \Ixocreate\Validation\Result\Result::__construct
     */
    public function testIsSuccessful()
    {
        $result = new Result($this->emptyViolationCollector);
        $this->assertTrue($result->isSuccessful());

        $result = new Result($this->violationCollector);
        $this->assertFalse($result->isSuccessful());
    }

    /**
     * @covers \Ixocreate\Validation\Result\Result::has
     * @covers \Ixocreate\Validation\Result\Result::__construct
     */
    public function testHas()
    {
        $result = new Result($this->emptyViolationCollector);
        $this->assertFalse($result->has("name"));

        $result = new Result($this->violationCollector);
        $this->assertTrue($result->has("name"));
        $this->assertTrue($result->has("email"));
        $this->assertFalse($result->has("something_else"));
    }

    /**
     * @covers \Ixocreate\Validation\Result\Result::get
     * @covers \Ixocreate\Validation\Result\Result::__construct
     */
    public function testGet()
    {
        $result = new Result($this->emptyViolationCollector);
        $this->assertSame(0, $result->get("name")->count());

        $result = new Result($this->violationCollector);
        $this->assertSame(1, $result->get("name")->count());
        $this->assertSame(2, $result->get("email")->count());
        $this->assertTrue(\in_array('invalid.email', $result->get("email")->extract("error")->toArray()));
        $this->assertTrue(\in_array('not.an.email', $result->get("email")->extract("error")->toArray()));
        $this->assertSame(0, $result->get("something_else")->count());
    }

    /**
     * @covers \Ixocreate\Validation\Result\Result::all
     * @covers \Ixocreate\Validation\Result\Result::__construct
     */
    public function testAll()
    {
        $result = new Result($this->emptyViolationCollector);
        $this->assertSame(0, $result->all()->count());

        $result = new Result($this->violationCollector);
        $this->assertSame(3, $result->all()->count());
        $this->assertTrue(\in_array('name', $result->all()->extract("name")->toArray()));
        $this->assertTrue(\in_array('email', $result->all()->extract("name")->toArray()));
    }

    /**
     * @covers \Ixocreate\Validation\Result\Result::jsonSerialize
     * @covers \Ixocreate\Validation\Result\Result::__construct
     */
    public function testJsonSerialize()
    {
        $result = new Result($this->emptyViolationCollector);
        $this->assertSame([], $result->jsonSerialize());

        $result = new Result($this->violationCollector);
        $this->assertArrayHasKey('name', $result->jsonSerialize());
        $this->assertArrayHasKey('email', $result->jsonSerialize());
        $this->assertCount(1, $result->jsonSerialize()['name']);
        $this->assertCount(2, $result->jsonSerialize()['email']);
    }
}
