<?php

namespace GabrielStarling\ProductReviews\Block\Product;

use GabrielStarling\ProductReviews\Block\Product\ReviewsList\Toolbar;
use GabrielStarling\ProductReviews\Helper\Dictionary;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Helper\Product;
use Magento\Catalog\Model\ProductTypes\ConfigInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Json\EncoderInterface as JsonEncoder;
use Magento\Framework\Locale\FormatInterface;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\Stdlib\StringUtils;
use Magento\Framework\Url\EncoderInterface as UrlEncoder;
use Magento\Review\Block\Product\View\ListView;
use Magento\Review\Model\ResourceModel\Review\Collection as ReviewCollection;
use Magento\Review\Model\ResourceModel\Review\CollectionFactory;
use Magento\Review\Model\Review;
use Magento\Store\Model\ScopeInterface;

class View extends ListView
{
    private $toolbarData;
    private $config;

    public function __construct(
        Context $context,
        UrlEncoder $urlEncoder,
        JsonEncoder $jsonEncoder,
        StringUtils $string,
        Product $productHelper,
        ConfigInterface $productTypeConfig,
        FormatInterface $localeFormat,
        Session $customerSession,
        ProductRepositoryInterface $productRepository,
        PriceCurrencyInterface $priceCurrency,
        CollectionFactory $collectionFactory,
        ScopeConfigInterface $config,
        Toolbar $toolbar,
        array $data = []
    ) {
        $this->toolbarData = $toolbar;
        $this->config = $config;
        parent::__construct(
            $context,
            $urlEncoder,
            $jsonEncoder,
            $string,
            $productHelper,
            $productTypeConfig,
            $localeFormat,
            $customerSession,
            $productRepository,
            $priceCurrency,
            $collectionFactory,
            $data
        );
    }

    private function isModuleEnabled(): bool
    {
        return (bool) $this->config->getValue(Dictionary::ORDERED_REVIEWS_ENABLED, ScopeInterface::SCOPE_STORE);
    }

    public function getReviewsCollection(): ReviewCollection
    {
        if (!$this->isModuleEnabled()) {
            return parent::getReviewsCollection();
        }

        if (null === $this->_reviewsCollection) {
            $this->_reviewsCollection = $this->_reviewsColFactory->create()->addStoreFilter(
                $this->_storeManager->getStore()->getId()
            )
            ->addStatusFilter(Review::STATUS_APPROVED)
            ->addEntityFilter(
                'product',
                $this->getProduct()->getId()
            );

            $this->_reviewsCollection->getSelect()->joinLeft(
                ['option_vote' => 'rating_option_vote'],
                'main_table.review_id=option_vote.review_id',
                'percent'
            );

            $this->_reviewsCollection->setOrder(...$this->toolbarData->getOrder());
        }
        return $this->_reviewsCollection;
    }
}