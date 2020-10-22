<?php

namespace Tests\Unit;

use App\Rules\CPFValidoRule;
use PHPUnit\Framework\TestCase;

class TestCPFRule extends TestCase
{
    /**
     * @var CPFValidoRule
     */
    private CPFValidoRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new CPFValidoRule();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDeveAceitarCPFComValorVazio()
    {
        $this->assertTrue($this->rule->passes('attr', ''));
    }

    /**
     * @dataProvider cpfValidos
     * @param string $cpf
     * @return void
     */
    public function testDeveAceitarCPFValido($cpf)
    {
        $this->assertTrue($this->rule->passes('attr', $cpf));
    }

    /**
     * @dataProvider cpfInvalidos
     * @param string $cpf
     * @return void
     */
    public function testNaoPodeAceitarCPFInvalido($cpf)
    {
        $this->assertFalse($this->rule->passes('attr', $cpf));
    }

    public function cpfValidos()
    {
        return [
            ['927.755.439-87'],
            ['339.431.414-20'],
            ['33661241800'],
            ['57734018351'],
        ];
    }

    public function cpfInvalidos()
    {
        return [
            ['0'],
            ['339.431.414-2'],
            ['927.755.439-88'],
            ['927.755.439-870'],
            ['57734018352'],
            ['336612418000'],
            ['11111111111'],
            ['88888888888'],
        ];
    }
}
