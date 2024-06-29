Nette Web Project
=================

This is a basic test application built using Nette framework using custom generate console command.


Genette Console Commands
----------------

Generate quickly Presenters, Models, Forms, Services using console command `php genette`


Generate Presenter
----------------
    php genette create:presenter <PresenterName>

    php genette create:presenter <PresenterName> --path=<OtherPath>

    e.g. php genette create:presenter Dashboard --path=app/UI/Backend

**Important Note:** `<PresenterName>` only using the name without the  `Presenter` suffix


Generate Model/Repository
----------------
    php genette create:model <ModelName>

    php genette create:model <ModelName> --table=<TableName>

    e.g. php genette create:model Users --table=tbl_users


Generate Service
----------------
    php genette create:service <ServiceName>

    php genette create:service <ServiceName> --path=<OtherPath>

    e.g. php genette create:service PayPay --path=app/Services


Generate Form
----------------
    php genette create:form <FormName>

    php genette create:form <FormName> --path=<OtherPath>

    e.g. php genette create:form User --path=app/Forms


**Important Note:** `<FormName>` only using the name without the  `FormFactory` suffix

