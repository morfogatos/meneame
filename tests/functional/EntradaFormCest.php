<?php
use app\models\User;
use app\models\Entrada;
use dektrium\user\models\RegistrationForm;
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
        Entrada::deleteAll();
        User::deleteAll();
        $user = new RegistrationForm();
        $user->username = 'prueba';
        $user->password = 'prueba';
        $user->email = 'prueba@gmail.com';
        $user->register();
        $I->amLoggedInAs(User::findOne(['username' => 'prueba'])->id);
        $I->amOnPage(['entradas/create']);
    }

    public function openEnviarEntradaPage(\FunctionalTester $I)
    {
        $I->see('Enviar Entrada', 'h1');
    }

    public function enviarEntradaExitosamente(\FunctionalTester $I)
    {
        $I->submitForm('#form-enviar', [
            'Entrada[url]' => 'http://github.com',
            'Entrada[titulo]' => 'awdadwa',
            'Entrada[texto]' => 'waifjoaiwjfa',
            'Entrada[categoria_id]' => 1,
            'Entrada[nombre]' => 'hola, pepe'
        ]);
        $I->dontSeeElement('#form-enviar');
        $I->amOnPage(['entradas/view']);
    }

    public function enviarEntradaVacia(\FunctionalTester $I)
    {
        $I->submitForm('#form-enviar', []);
        $I->expectTo('see validations errors');
        $I->see('Url no puede estar vacío.');
        $I->see('Titulo de la entrada no puede estar vacío.');
        $I->see('Descripción de la entrada no puede estar vacío.');
        $I->see('Categoria no puede estar vacío.');
        $I->see('Etiquetas no puede estar vacío.');
    }
}
