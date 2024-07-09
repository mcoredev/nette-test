Nette Web Project
=================

This is a basic test application built Nette framework with custom generate console command.


Nette Console Commands
----------------

Generate quickly Presenters, Models, Forms, Services, Control using console command `php nette`

Important note!!!
----------------
The **php nette** commands are only run by this application, which has a **BasePresenter** created and customized for its needs.
It serves only as an inspiration and demo.

Generate Presenter
----------------
    php nette create:presenter <PresenterName>

command generate Presenter to standard path **App/UI/PresenterNameFolder/PresenterName.php** 
    
    php nette create:presenter <PresenterName> --path=<your_changed_path>

command generate Presenter to changed path app/<your_changed_path> e.g.:

    php nette create:presenter Dashboard --path=App/UI/Backend

command will generate App/UI/Backend/Dashboard/DashboardPresenter.php

**Important Note:** `<PresenterName>` only using the name without the  `Presenter` suffix


Generate Model/Repository
----------------
    php nette create:model <ModelName>

command will generate Model/Repository to standard path **App/Models/ModelName.php**

    php nette create:model <ModelName> --table=<TableName>

command will generate Model/Repository with name of table e.g.:

    php nette create:model Users --table=tbl_users

command will generate App/Models/UserRepository.php with the internal table name tbl_users

Generate Service
----------------
    php nette create:service <ServiceName>

command will generate Service Class to standard path **App/Services/ServiceName.php**

    php nette create:service <ServiceName> --path=<your_changed_path>

command will generate Service Class to changed path app/<your_changed_path> e.g.:

    php nette create:service PayPay --path=App/Admin/Services

command will generate App/Services/Paypal.php

Generate Form
----------------
    php nette create:form <FormName>

command will generate Form Class to standard path **App/Forms/FormNameFormFactory.php**

    php nette create:form <FormName> --path=<your_changed_path>

command will generate Form Class to changed path app/<your_changed_path> e.g.:

    php nette create:form User --path=App/Admin/Forms

command will generate App/Admin/Forms/UserFormFactory.php

**Important Note:** `<FormName>` only using the name without the  `FormFactory` suffix

Generate Control
----------------
    php nette create:control <ControlName>

command will generate Control Class to standard path **App/Control/ControlName/Control.php**

    php nette create:control <ControlName> --path=<your_changed_path>

command will generate Control Class to changed path app/<your_changed_path> e.g.:

    php nette create:control Project/Grid --path=App/Components

command will generate: 
- App/Components/Project/Grid/Control.php
- App/Components/Project/Grid/ControlFactory.php
- App/Components/Project/Grid/default.latte


License
----------------
MIT
