<?php

$API = new PerchAPI(1.0, 'pipit_catalog');
$UserPrivileges = $API->get('UserPrivileges');
$UserPrivileges->create_privilege('pipit_catalog', 'Access the Catalog app');

$Settings->set('pipit_catalog_update', PIPIT_CATALOG_VERSION);