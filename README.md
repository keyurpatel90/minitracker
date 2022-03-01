# Mage2 Module Loop MiniTracker

    ``loop/module-minitracker``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
Module to track code against sku

## Installation

### Type 1: Zip file

 - Unzip the zip file in `app/code/Loop`
 - Enable the module by running `php bin/magento module:enable Loop_MiniTracker`
 - Apply database updates by running `php bin/magento setup:upgrade --keep-generated`
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require loop/module-minitracker`
 - enable the module by running `php bin/magento module:enable Loop_MiniTracker`
 - apply database updates by running `php bin/magento setup:upgrade --keep-generated`
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration




## Specifications

 - API Endpoint
	- GET - Loop\MiniTracker\Api\TrackingManagementInterface > Loop\MiniTracker\Model\TrackingManagement

 - Helper
	- Loop\MiniTracker\Helper\Data

 - Model
	- TrackingInfo

 - Observer
	- checkout_cart_add_product_complete > Loop\MiniTracker\Observer\Frontend\Checkout\CartAddProductComplete


## Attributes



