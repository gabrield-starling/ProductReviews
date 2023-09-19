<?php

namespace GabrielStarling\ProductReviews\Block\Product\ReviewsList;

use GabrielStarling\ProductReviews\Helper\Dictionary;
use Magento\Framework\Api\SortOrder;
use Magento\Theme\Block\Html\Pager;

class Toolbar extends Pager
{
    private $order = Dictionary::REVIEWS_CREATION_COLUMN;
    private $dir = SortOrder::SORT_ASC;

    public function getAvailableOrders(): array
    {
        return [
            Dictionary::REVIEWS_CREATION_COLUMN => 'Date',
            Dictionary::REVIEWS_RATING_COLUMN => 'Rating'
        ];
    }

    public function isOrderCurrent($order): bool
    {
        return $order === $this->getCurrentOrder();
    }

    public function getCurrentOrder(): string
    {
        return $this->getRequest()->getParam(Dictionary::REVIEWS_SORT_BY_PARAM, $this->order);
    }

    public function getCurrentDirection(): string
    {
        return $this->getRequest()->getParam(Dictionary::REVIEWS_DIRECTION_PARAM, $this->dir);
    }

    public function getOrder(): array
    {
        return [$this->getCurrentOrder(), $this->getCurrentDirection()];
    }
}