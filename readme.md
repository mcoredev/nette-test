Nette Web Project
=================

This is a basic test application built Nette framework with custom generate console command.


Genette Console Commands
----------------

Generate quickly Presenters, Models, Forms, Services using console command `php genette`

Important note!!!
----------------
The **php genette** commands are only run by this application, which has a **BasePresenter** created and customized for its needs.
It serves only as an inspiration and demo.

Generate Presenter
----------------
    php genette create:presenter <PresenterName>

command generate Presenter to standard path **app/UI/PresenterNameFolder/PresenterName.php** 
    
    php genette create:presenter <PresenterName> --path=<your_changed_path>

command generate Presenter to changed path app/<your_changed_path> e.g.:

    php genette create:presenter Dashboard --path=app/UI/Backend

command will generate app/UI/Backend/Dashboard/DashboardPresenter.php

**Important Note:** `<PresenterName>` only using the name without the  `Presenter` suffix


Generate Model/Repository
----------------
    php genette create:model <ModelName>

command will generate Model/Repository to standard path **app/Models/ModelName.php**

    php genette create:model <ModelName> --table=<TableName>

command will generate Model/Repository with name of table e.g.:

    php genette create:model Users --table=tbl_users

command will generate app/Models/UserRepository.php with the internal table name tbl_users

Generate Service
----------------
    php genette create:service <ServiceName>

command will generate Service Class to standard path **app/Services/ServiceName.php**

    php genette create:service <ServiceName> --path=<your_changed_path>

command will generate Service Class to changed path app/<your_changed_path> e.g.:

    php genette create:service PayPay --path=app/Admin/Services

command will generate app/Services/Paypal.php

Generate Form
----------------
    php genette create:form <FormName>

command will generate Form Class to standard path **app/Forms/FormNameFormFactory.php**

    php genette create:form <FormName> --path=<your_changed_path>

command will generate Form Class to changed path app/<your_changed_path> e.g.:

    php genette create:form User --path=app/Admin/Forms

command will generate app/Admin/Forms/UserFormFactory.php

**Important Note:** `<FormName>` only using the name without the  `FormFactory` suffix

License
----------------
MIT
