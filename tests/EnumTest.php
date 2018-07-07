<?php

class EnumTest extends \PHPUnit\Framework\TestCase
{

//    public function testNotExists()
//    {
//        Test::C();
//    }

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
        $this->assertTrue($e instanceof InvalidArgumentException);
        $this->assertEquals('constant Test::C not found', $e->getMessage());
    }

    public function testConstants()
    {
        $this->assertEquals(['A', 'B'], Test::names());
        $this->assertEquals(['a', 'b'], Test::values());
        $this->assertEquals([], T::names());
        $this->assertEquals([], T::values());
    }

    protected function typeHint(Test $test)
    {
        return $test->val();
    }

    public function testTypeHint()
    {
        $this->assertEquals(Test::A, $this->typeHint(Test::A()));
    }

    public function testDefined()
    {
        $this->assertTrue(Test::defined('A'));
        $this->assertFalse(Test::defined('C'));
    }

    public function testStaticCall()
    {
        try {

            Test::__callStatic('notExists', []);
        } catch (\InvalidArgumentException $e) {

        }

        $this->assertTrue(isset($e));
        $this->assertTrue($e instanceof InvalidArgumentException);
        $this->assertEquals('constant Test::notExists not found', $e->getMessage());
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
class T extends \Thirdgerb\Enum {
}