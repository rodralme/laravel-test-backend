<?php

namespace Tests\Unit;

use App\Rules\CNPJValidoRule;
use PHPUnit\Framework\TestCase;

class TestCNPJRule extends TestCase
{
    /**
     * @var CNPJValidoRule
     */
    private CNPJValidoRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new CNPJValidoRule();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDeveAceitarCNPJComValorVazio()
    {
        $this->assertTrue($this->rule->passes('attr', ''));
    }

    /**
     * @dataProvider cnpjValidos
     * @param string $cnpj
     * @return void
     */
    public function testDeveAceitarCNPJValido($cnpj)
    {
        $this->assertTrue($this->rule->passes('attr', $cnpj));
    }

    /**
     * @dataProvider cnpjInvalidos
     * @param string $cnpj
     * @return void
     */
    public function testNaoPodeAceitarCNPJInvalido($cnpj)
    {
        $this->assertFalse($this->rule->passes('attr', $cnpj));
    }

    public function cnpjValidos()
    {
        return [
            ['66.280.992/0001-66'],
            ['30.421.703/0001-54'],
            ['50321259000102'],
            ['46123882000183'],
        ];
    }

    public function cnpjInvalidos()
    {
        return [
            ['0'],
            ['66.280.992/0001-6'],
            ['66.280.992/0001-666'],
            ['66.280.992/0001-67'],
            ['11.111.111/1111-11'],
            ['5032125900010'],
            ['503212590001022'],
            ['88888888888888'],
        ];
    }
}
