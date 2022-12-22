<?php
namespace DigitalCollege\Dev\Api\Data;

/**
 * @api
 */
interface CategoryLinkManagementInterface
{
    /**
     * Get products assigned to a category
     *
     * @return \DigitalCollege\Dev\Api\Data\CategoryProductLinkInterface[]
     */
    public function getAssignedProducts();
}
