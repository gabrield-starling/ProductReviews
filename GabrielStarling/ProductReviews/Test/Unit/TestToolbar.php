<?php

namespace GabrielStarling\ProductReviews\Test\Unit;

use GabrielStarling\ProductReviews\Block\Product\ReviewsList\Toolbar;
use GabrielStarling\ProductReviews\Helper\Dictionary;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\App\Request\Http;
use Magento\Framework\View\Element\Template\Context;
use PHPUnit\Framework\TestCase;

class TestToolbar extends TestCase
{

    /**
     * Ensure the values returned from request are correct
     */
    public function testReviewsCollectionCreatedByAscFilter()
    {
        $request = $this->getMockBuilder(Http::class)
            ->disableOriginalConstructor()
            ->getMock();

        $context = $this->getMockBuilder(Context::class)
            ->disableOriginalConstructor()
            ->getMock();

        $request->method('getParam')
            ->withConsecutive(
                [Dictionary::REVIEWS_SORT_BY_PARAM, Dictionary::REVIEWS_CREATION_COLUMN],
                [Dictionary::REVIEWS_SORT_BY_PARAM, Dictionary::REVIEWS_CREATION_COLUMN],
                [Dictionary::REVIEWS_DIRECTION_PARAM, SortOrder::SORT_ASC]
            )
            ->willReturn(
                Dictionary::REVIEWS_CREATION_COLUMN,
                Dictionary::REVIEWS_CREATION_COLUMN,
                SortOrder::SORT_ASC
            );

        $context->method('getRequest')->willReturn($request);
        $toolbar = new Toolbar($context, []);
        $this->assertEquals(['created_at', 'percent'], array_keys($toolbar->getAvailableOrders()));
        $this->assertTrue($toolbar->isOrderCurrent('created_at'));
        $this->assertEquals('created_at', $toolbar->getCurrentOrder());
        $this->assertEquals('ASC', $toolbar->getCurrentDirection());
    }
}