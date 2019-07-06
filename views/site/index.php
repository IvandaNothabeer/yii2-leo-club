<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'LeoClub';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome!</h1>

        <p class="lead">To the Leonberger Club NZ Member Hub.</p>

        <p><a class="btn btn-lg btn-success" href="<?=Url::base(true).'/user/login'?>">Login Here</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Members</h2>

                <p>Here you can verify your membership details and annual subs status </br>
                    You will need to Register using the E-Mail address that the Leonberger Club already has on file for you.
                    You will receive a confirmation email to verify your registration</br>
                    Once you have registered, you can update your contact details as required</p>

                <p><a class="btn btn-default" href="<?=Url::base(true).'/member'?>">Member List &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Dogs</h2>

                <p>Here you can Verify and Update the details for any dogs that you own. </br>
                </p>

                <p><a class="btn btn-default" href="<?=Url::base(true).'/dog'?>">Dogs &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Shows</h2>

                <p>Here you can enter your dogs into upcoming shows and manage your show entries
                </p>

                <p><a class="btn btn-default" href="<?=Url::base(true).'/show'?>">Shows &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
