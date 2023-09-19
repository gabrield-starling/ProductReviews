# Product Reviews - Enhanced

## Overview

The Product Reviews Module is a custom module developed to enhance the Product Reviews section on the Magento Product View page. This module allows customers to sort product reviews by rating or date providing a more user-friendly and informative experience for your Magento store visitors.

## Features

- **Sorting Options**: Customers can sort product reviews by various criteria, including:
  - Rating (highest to lowest)
  - Date (newest to oldest)
- **Enhanced User Experience**: Improve user experience by providing convenient review sorting options.
- **Easy Installation**: Quick and hassle-free installation process.

## Installation

### Prerequisites

- Magento 2.x installed and running.

### Installation Steps

1. **Download the Module**:

   Download the latest release of the module from the [GitHub repository](https://github.com/gabrield-starling/product-reviews).

2. **Install the Module**:

   Copy the module files to your Magento root directory:

   ```shell
   cp -r ./GabrielStarling/ProductReviews/ <your-magento-root>/app/code/GabrielStarling/ProductReviews/


## Running Tests

You can run the tests for this Magento module to ensure that it functions correctly. Follow these steps to execute the tests:

### Prerequisites

Before running the tests, ensure that you have the following prerequisites:

1. A Magento 2.x installation set up and running.

2. Composer installed on your system.

### Installation of PHPUnit

If PHPUnit is not already installed globally or in your project's dependencies, you can add it as a development dependency using Composer. In your Magento root directory, run the following command:

```bash
composer require --dev phpunit/phpunit
```

### Running
To run the tests for this module, use the following command in your Magento root directory:

```bash
vendor/bin/phpunit -c dev/tests/unit/phpunit.xml.dist app/code/GabrielStarling/ProductReviews/Test/Unit/TestToolbar.php
```


Viewing Test Results
PHPUnit will run the tests and provide you with the test results, including the number of tests executed, assertions made, and any failures or errors encountered during testing.

Make sure that all tests pass without failures or errors before deploying this module to your production environment.