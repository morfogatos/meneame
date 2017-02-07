<?php

use \Codeception\Util\Locator;

/**
 *
 */
class EntradaFormCest
{
    /**
     * [_before description]
     * @param  FunctionalTester $I [description]
     * @return [type]              [description]
     */
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnRoute('entrada/enviar');

    }

    /**
     * [_after description]
     * @param  FunctionalTester $I [description]
     * @return [type]              [description]
     */
    public function _after(FunctionalTester $I)
    {
    }

    // public function enviarEntradaExitosamente(\FunctionalTester $I)
    // {
    //     $I->submitForm('#form-enviar', [
    //         'Entrada[url]' => 'http://github.com',
    //         'Entrada[titulo]' => 'awdadwa',
    //         'Entrada[text]' => 'waifjoaiwjfa',
    //         'Entrada[categoria_id]' => 1,
    //         'Entrada[nombre]' => 'hola, pepe'
    //     ]);
    // }

    public function openEnviarEntradaPage(\FunctionalTester $I)
    {
        $I->see('Enviar Entrada', 'h1');
    }


}
