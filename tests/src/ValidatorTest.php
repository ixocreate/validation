<?php
namespace IxocreateTest\Validator;

use Ixocreate\Contract\Validation\ValidatableInterface;
use Ixocreate\Validation\Result;
use Ixocreate\Validation\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    /**
     * @var Validator
     */
    private $validator;

    private $validatable;

    public function setUp()
    {
        $this->validator = new Validator();
        $this->validatable = $this->getMockBuilder(ValidatableInterface::class)
            ->getMock();
    }

    /**
     * @covers \Ixocreate\Validation\Validator::supports
     */
    public function testSupports()
    {
        $this->assertFalse($this->validator->supports("string"));
        $this->assertFalse($this->validator->supports(new \stdClass()));


        $this->assertTrue($this->validator->supports($this->validatable));
    }

    /**
     * @covers \Ixocreate\Validation\Validator::validate
     */
    public function testValidateException()
    {
        $this->expectException(\Exception::class);

        $this->validator->validate("string");
    }

    /**
     * @covers \Ixocreate\Validation\Validator::validate
     */
    public function testValidatable()
    {
        $result = $this->validator->validate($this->validatable);
        $this->assertInstanceOf(Result::class, $result);
    }
}