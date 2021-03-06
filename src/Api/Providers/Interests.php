<?php

namespace seregazhuk\PinterestBot\Api\Providers;

use seregazhuk\PinterestBot\Helpers\Pagination;
use seregazhuk\PinterestBot\Helpers\UrlBuilder;
use seregazhuk\PinterestBot\Api\Providers\Core\Provider;
use seregazhuk\PinterestBot\Api\Traits\HasRelatedTopics;

class Interests extends Provider
{
    use HasRelatedTopics;

    protected $feedUrl = UrlBuilder::RESOURCE_GET_CATEGORY_FEED;

    /**
     * @var array
     */
    protected $loginRequiredFor = [
        'main',
    ];

    /**
     * Get list of main categories
     *
     * @return array|bool
     */
    public function main()
    {
        return $this->get(["category_types" => "main"], UrlBuilder::RESOURCE_GET_CATEGORIES);
    }

    /**
     * Get category info
     *
     * @param string $category
     * @return array|bool
     */
    public function info($category)
    {
        return $this->get(["category" => $category], UrlBuilder::RESOURCE_GET_CATEGORY);
    }

    /**
     * Returns a feed of pins.
     *
     * @param string $interest
     * @param int $limit
     * @return Pagination
     */
    public function pins($interest, $limit = Pagination::DEFAULT_LIMIT)
    {
        $data = [
            'feed'             => $interest,
            'is_category_feed' => true,
        ];

        return $this->paginate($data, UrlBuilder::RESOURCE_GET_CATEGORY_FEED, $limit);
    }
}
