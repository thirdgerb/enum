<?php

class EnumTest extends \PHPUnit\Framework\TestCase
{

    public function testEnum()
    {
        $a = Test::A();
        $b = Test::B();

        $this->assertTrue($a instanceof \Thirdgerb\Enum);
        $this->assertTrue($b instanceof \Thirdgerb\Enum);

        $this->assertEquals(Test::A, $a->val());
        $this->assertEquals(Test::B, $b->val());

        $this->assertEquals('A', $a->name());
        $this->assertEquals('B', $b->name());

        $this->assertEquals('Test::A', strval($a));
        $this->assertEquals('Test::B', strval($b));
        $this->assertEquals((string)$a, $a->constName() );

        $this->assertTrue($a->equals(Test::A));
    }

    public function testException()
    {
        try {
            $c = Test::C();
        } catch (Exception $e) {

        }

        $this->assertTrue(isset($e));
        $this->assertEquals('constant(): Couldn\'t find constant Test::C', $e->getMessage());
    }

    protected function typehint(Test $test)
    {
        return $test->val();
    }

    public function testTypeHint()
    {
        $this->assertEquals(Test::A, $this->typehint(Test::A()));
    }

}

/**
 * @method static A
 * @method static B
 * Class Test
 */
class Test extends \Thirdgerb\Enum {

    const A = 'a';

    const B = 'b';

}