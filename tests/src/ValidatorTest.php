<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOLIT GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\Test\Validation;

use Ixocreate\Validation\Result\Result;
use Ixocreate\Validation\ValidatableInterface;
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
