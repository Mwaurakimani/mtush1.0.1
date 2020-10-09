<?php
  
  define('PATH',
  array(
    'dashboard' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/dashboard/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/dashboard/view.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/dashboard/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/dashboard/class.php'
    ),
    'pointOfSale' => array(
      'path'=> $_SERVER['DOCUMENT_ROOT'] . '/Views/pointOfSale/',
      'view'=> $_SERVER['DOCUMENT_ROOT'].'/Views/pointOfSale/view.php',
      'control'=> $_SERVER['DOCUMENT_ROOT'].'/Views/pointOfSale/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'].'/Views/pointOfSale/class.php'
    ),

    'catalogue' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/catalogue/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/catalogue/view.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/catalogue/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/catalogue/class.php',
      'catalogueInput' => $_SERVER['DOCUMENT_ROOT'] . '/Views/catalogue/catalogueInput.php',
    ),
    'customers' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/customers/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/customers/view.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/customers/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/customers/class.php'
    ),
    'sales' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/sales/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/sales/view.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/sales/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/sales/class.php'
    ),
    'transactions' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/transactions/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/transactions/view.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/transactions/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/transactions/class.php'
    ),
    'vendors' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/vendors/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/vendors/view.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/vendors/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/vendors/class.php',
      'vendorInput' => $_SERVER['DOCUMENT_ROOT'] . '/Views/vendors/vendorInput.php',
    ),
    'accounts' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/accounts/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/accounts/view.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/accounts/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/accounts/class.php'
    ),
    'notifications' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/notifications/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/notifications/view.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/notifications/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/notifications/class.php'
    ),
    'reports' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/reports/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/reports/view.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/reports/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/reports/class.php'
    ),
    'inference' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/inference/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/inference/view.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/inference/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/inference/class.php'
    ),
    'userAccount' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/userAccount/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/userAccount/view.php',
      'userAccountInput' => $_SERVER['DOCUMENT_ROOT'] . '/Views/userAccount/userAccountInput.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/userAccount/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/userAccount/class.php'

    ),
    'moderators' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/moderators/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/moderators/view.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/moderators/control.php',
      'userAccountInput' => $_SERVER['DOCUMENT_ROOT'] . '/Views/moderators/userAccountInput.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/moderators/class.php'
    ),
    'locations' => array(
      'path' => $_SERVER['DOCUMENT_ROOT'] . '/Views/locations/',
      'view' => $_SERVER['DOCUMENT_ROOT'] . '/Views/locations/view.php',
      'control' => $_SERVER['DOCUMENT_ROOT'] . '/Views/locations/control.php',
      'class' => $_SERVER['DOCUMENT_ROOT'] . '/Views/locations/class.php'
    ),
  ));