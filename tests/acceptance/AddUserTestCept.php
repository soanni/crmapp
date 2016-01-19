<?php

namespace Step\Acceptance;


$I = new CRMOperatorSteps($scenario);
$I->wantTo('add two different customers to database');
$I->amInAddCustomerUI();
$first_customer = $I->imagineCustomer();
$I->fillCustomerDataFrom($first_customer);
$I->submitCustomerDataForm();
$I->seeIAmInListCustomersUi();

$I->amInAddCustomerUI();
$second_customer = $I->imagineCustomer();
$I->fillCustomerDataFrom($second_customer);
$I->submitCustomerDataForm();
$I->seeIAmInListCustomersUi();

$I = new CRMUserSteps($scenario);
$I->wantTo('query the customer info using his phone number');
$I->amInQueryCustomerUi();
$I->fillInPhoneFieldWithDataFrom($first_customer);
$I->clickSearchButton();

$I->seeIAmInListCustomersUi();
$I->seeCustomerInList($first_customer);
$I->dontSeeCustomerInList($second_customer);

