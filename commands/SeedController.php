<?php
/**
* @link http://www.yiiframework.com/
* @copyright Copyright (c) 2008 Yii Software LLC
* @license http://www.yiiframework.com/license/
*/

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use Yii;


/**
* This command seeds the Members table
*
*/
class SeedController extends Controller
{
    /**
    * This command echoes what you have entered as the message.
    * @param string $message the message to be echoed.
    * @return int Exit code
    */
    public function actionIndex()
    {
        $result = Yii::$app->db->createCommand()->checkIntegrity(false)->execute();

        $seeder = new \tebazil\yii2seeder\Seeder();
        $generator = $seeder->getGeneratorConfigurator();
        $faker = $generator->getFakerConfigurator();

        $seeder->table('{{%member}}')->columns([
            'id', //automatic pk
            'firstname'=>$faker->firstName,
            'lastname'=>$faker->lastName,
            'address' => $faker->address,
            'city' => $faker->city,
            'telephone' => $faker->phoneNumber,
            'mobile' => $faker->phoneNumber,
            'joined' => $faker->date(),
            'membership' => $faker->randomElement([1,2,3,4,5,6]),
            'email' => $faker->email,
            'active' => 1
        ])->rowQuantity(30);

        $seeder->table('{{%dog}}')->columns([
            'id', //automatic pk
            'member_id', //automatic fk
            'name' => $faker->firstName,
            'pedigreeName'=> $faker->name,
            'breeder'=> $faker->name,
            'dob' => $faker->date(),
            'sex' => $faker->randomElement([0,1]),
        ])->rowQuantity(40);

        $seeder->table('{{%transaction}}')->columns([
            'id', //automatic pk
            'member_id', //automatic fk
            'date' => $faker->date(),
            'type' => $faker->randomElement([1,2,3,4,5,6,7,8,9]),
            'description' => $faker->randomElement(['Annual Subs','Purchase from Store','Donation']),
            'amount' => $faker->numberBetween(0,200),
            'payment_method' => $faker->randomElement(['Paypal','Check','Cash']),
            'reference' => $faker->numberBetween(1000,1000000),
            'account' => $faker->randomElement(['Subs','Sales']),
        ])->rowQuantity(1000);
        
        $seeder->refill();

        return ExitCode::OK;
    }
}
