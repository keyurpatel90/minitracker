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

 - Install the module composer by running `composer require loop/module-minitracker`
 - enable the module by running `php bin/magento module:enable Loop_MiniTracker`
 - apply database updates by running `php bin/magento setup:upgrade --keep-generated`
 - Flush the cache by running `php bin/magento cache:flush`

## Configuration
- Go to Store->configuration->Loop->Tracking configuration
- Enable the module 
- Configure the tracking api url
- Configure api connection timeout (30 sec)

## Queue configuration
- Module MiniTracker is using queue (MySql based) to send request to tracking api
- Following is the command to start queue to consume message
`bin/magento queue:consumers:start requestProcessor --max-messages=50`
where `requestProcessor` is the queue name 
## API Specifications

 - Get all tracking
	- GET - `/V1/loop-minitracker/tracking`

 - Get id specific record 
	- GET - `/V1/loop-minitracker/trackinginfo/:trackinginfoId`

 - Search record
	- GET - `/V1/loop-minitracker/trackinginfo/search`

 




