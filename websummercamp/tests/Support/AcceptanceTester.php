<?php

declare(strict_types=1);

namespace App\Tests\Support;

/**
 * Inherited Methods
 *
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    public function actAsUser($email, $password, $createNew = false) {

        $I = $this;

        $sessionName = 'userLogin_' . $email;

        // if snapshot exists - skipping login
        if (!$createNew && $I->loadSessionSnapshot($sessionName)) {
            return;
        }

        $I->amOnPage('/login');
        $I->wait(1);

        $I->fillField('_username', $email);
        $I->fillField('_password', $password);

        $I->click('button[type="submit"]');
        $I->wait(2);

        $I->saveSessionSnapshot($sessionName);
    }
}
