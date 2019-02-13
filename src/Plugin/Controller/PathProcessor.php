<?php

namespace Xsarus\RestApi\Plugin\Controller;

use Magento\Framework\Locale\Resolver;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Webapi\Controller\PathProcessor as BasePathProcessor;

/**
 * Class PathProcessor
 */
class PathProcessor
{
    /**
     * @var Resolver
     */
    protected $localeResolver;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * PathProcessor constructor.
     * @param StoreManagerInterface $storeManager
     * @param Resolver $localeResolver
     */
    public function __construct(
        StoreManagerInterface $storeManager,
        Resolver $localeResolver
    ) {
        $this->storeManager = $storeManager;
        $this->localeResolver = $localeResolver;
    }

    /**
     * @param BasePathProcessor $subject
     * @param $result
     * @return array
     */
    public function afterProcess(BasePathProcessor $subject, $result)
    {
        $this->localeResolver->emulate($this->storeManager->getStore()->getId());
        return $result;
    }
}
