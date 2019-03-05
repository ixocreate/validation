<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace IxocreateTest\Validator\Violation;

use Ixocreate\Collection\Exception\InvalidType;
use Ixocreate\Validation\Violation\Violation;
use Ixocreate\Validation\Violation\ViolationCollection;
use PHPUnit\Framework\TestCase;

class ViolationCollectionTest extends TestCase
{
    private function data()
    {
        return [
            'violation1' => new Violation("name", "invalid.name"),
            'violation2' => new Violation("name", "invalid.name"),
            'violation3' => new Violation("name", "invalid.name"),
        ];
    }

    public function testCollection()
    {
        $data = $this->data();

        $collection = new ViolationCollection($data);
        $this->assertCount(3, $collection);

        $collection = new ViolationCollection($collection);
        $this->assertSame($data, $collection->toArray());
    }

    public function testInvalidTypeException()
    {
        $this->expectException(InvalidType::class);
        (new ViolationCollection(['test' => 'One']))->toArray();
    }
}
