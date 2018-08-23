<?php
namespace KiwiSuiteTest\Validator;

use KiwiSuite\Contract\Validation\ValidatableInterface;
use KiwiSuite\Validation\Result;
use KiwiSuite\Validation\Validator;
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
     * @covers \KiwiSuite\Validation\Validator::supports
     */
    public function testSupports()
    {
        $this->assertFalse($this->validator->supports("string"));
        $this->assertFalse($this->validator->supports(new \stdClass()));


        $this->assertTrue($this->validator->supports($this->validatable));
    }

    /**
     * @covers \KiwiSuite\Validation\Validator::validate
     */
    public function testValidateException()
    {
        $this->expectException(\Exception::class);

        $this->validator->validate("string");
    }

    /**
     * @covers \KiwiSuite\Validation\Validator::validate
     */
    public function testValidatable()
    {
        $result = $this->validator->validate($this->validatable);
        $this->assertInstanceOf(Result::class, $result);
    }
}