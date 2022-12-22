<?php
namespace DigitalCollege\Dev\Model;

/**
 * Class CategoryLinkManagement
 */
class CategoryLinkManagement implements \DigitalCollege\Dev\Api\Data\CategoryLinkManagementInterface, \DigitalCollege\Dev\Api\Data\ProductLinkManagementInterface
{
    /**
     * @var \Magento\Catalog\Api\CategoryRepositoryInterface
     */
    protected $categoryRepository;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    protected $productRepository;


    /**
     * @var \DigitalCollege\Dev\Api\Data\CategoryProductLinkInterfaceFactory
     */
    protected $productLinkFactory;

    /**
     * CategoryLinkManagement constructor.
     *
     * @param \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     * @param \DigitalCollege\Dev\Api\Data\CategoryProductLinkInterfaceFactory $productLinkFactory
     */
    public function __construct(
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \DigitalCollege\Dev\Api\Data\CategoryProductLinkInterfaceFactory $productLinkFactory
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->productLinkFactory = $productLinkFactory;
        $this->productRepository = $productRepository;

    }

    /**
     * {@inheritdoc}
     */
    public function getAssignedProducts()
    {
        $category = $this->categoryRepository->get(2);
        if (!$category->getIsActive()) {
            return [[
                'error' => true,
                'error_desc' => 'Category is disabled'
            ]];
        }
        $categoryDesc = $category->getDescription();

        /** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $products */
        $products = $category->getProductCollection()
            ->addFieldToSelect('position')
            ->addFieldToSelect('name')
            ->addFieldToSelect('price');

        /** @var \DigitalCollege\Dev\Api\Data\CategoryProductLinkInterface[] $links */
        $links = [];

        /** @var \Magento\Catalog\Model\Product $product */
        foreach ($products->getItems() as $product) {
            /** @var \DigitalCollege\Dev\Api\Data\CategoryProductLinkInterface $link */
            $link = $this->productLinkFactory->create();
            $link->setSku($product->getSku())
                ->setName($product->getName())
                ->setPrice($product->getFinalPrice())
                ->setPosition($product->getData('cat_index_position'))
                ->setCategoryDescription($categoryDesc);
            $links[] = $link;
        }

        return $links;
    }

    public function getProductsbyId($id)
    {
        $product = $this->productRepository->getById($id);

        /** @var \DigitalCollege\Dev\Api\Data\CategoryProductLinkInterface[] $links */
        $links = [];
            $link = $this->productLinkFactory->create();
            $link->setSku($product->getSku())
                ->setName($product->getName())
                ->setPrice($product->getFinalPrice())
                ->setPosition($product->getData('cat_index_position'));
            $links[] = $link;


        return $links;
    }
}
