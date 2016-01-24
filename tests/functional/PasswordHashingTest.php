<?php


class PasswordHashingTest extends \Codeception\TestCase\Test
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testMe()
    {
        $this->passwordIsHashedWhenSavingUser();
        $this->passwordIsNotRehashedAfterUpdatingWithoutChangingPassword();
    }

    private function passwordIsHashedWhenSavingUser(){
        $user = $this->imagineUserRecord();
        $plaintext_password = $user->password;
        $user->save();
        $saved_user = \app\models\user\UserRecord::findOne($user->id);
        $security = new \yii\base\Security();
        $this->assertInstanceOf(get_class($user),$saved_user);
        $this->assertTrue($security->validatePassword(
            $plaintext_password
            ,$saved_user->password)
        );
    }

    private function passwordIsNotRehashedAfterUpdatingWithoutChangingPassword(){
        $user = $this->imagineUserRecord();
        $user->save();

        $saved_user = \app\models\user\UserRecord::findOne($user->id);
        $expected_hash = $saved_user->password;

        $saved_user->username = md5(time());
        $saved_user->save();

        $updated_user = \app\models\user\UserRecord::findOne($saved_user->id);
        $this->assertEquals($expected_hash,$saved_user->password);
        $this->assertEquals($expected_hash, $updated_user->password);
    }

    private function imagineUserRecord(){
        $faker = Faker\Factory::create();
        $user = new \app\models\user\UserRecord();
        $user->username = $faker->word;
        $user->password = md5(time());
        return $user;
    }
}