<?php
use app\models\User;
use app\models\Entrada;

/**
 *
 */
class RegistrarFormCest
{
    /**
     * [_before description]
     * @param  FunctionalTester $I [description]
     * @return [type]              [description]
     */
    public function _before(FunctionalTester $I)
    {
        $I->amOnPage(['user/registration/register']);
    }

    /**
     * [tryToTest description]
     * @param  FunctionalTester $I [description]
     * @return [type]              [description]
     */
    public function openRegistrarForm(FunctionalTester $I)
    {
        $I->see('Registrarse', 'h3');
    }

    /**
     * [registrarExitoso description]
     * @param  FunctionalTester $I [description]
     * @return [type]              [description]
     */
    public function registrarExitoso(FunctionalTester $I)
    {
        $I->submitForm('#registration-form', [
            'register-form[email]' => 'tester@email.com',
            'register-form[username]' => 'tester',
            'register-form[password]' => 'tester',
        ]);
        // $I->seeEmailIsSent();
        $I->dontSeeElement('#registration-form');
        $I->see('Your account has been created and a message with further instructions has been sent to your email');
    }

    /**
     * [registrarFormularioVacio description]
     * @param  FunctionalTester $I [description]
     * @return [type]              [description]
     */
    public function registrarFormularioVacio(\FunctionalTester $I)
    {
       $I->submitForm('#registration-form', []);
       $I->expectTo('see validations errors');
       $I->see('Correo electrónico no puede estar vacío.');
       $I->see('Nombre de usuario no puede estar vacío.');
       $I->see('Contraseña no puede estar vacío.');
    }

    /**
     * [registrarFormularioConEmailIncorrecto description]
     * @param  FunctionalTester $I [description]
     * @return [type]              [description]
     */
    public function registrarFormularioConEmailIncorrecto(\FunctionalTester $I)
    {
        $I->submitForm('#registration-form', [
            'register-form[email]' => 'tester',
            'register-form[username]' => 'tester.email',
            'register-form[password]' => 'tester',
        ]);
       $I->dontSee('Nombre de usuario no puede estar vacío.');
       $I->see('Correo electrónico no es una dirección de correo válida.');
       $I->dontSee('Contraseña no puede estar vacío.');
    }
}
