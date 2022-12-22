<?php
namespace DigitalCollege\Dev\Observer;

use DigitalCollege\Dev\Model\DigitalFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;



class DigitalLogin implements ObserverInterface
{
    protected $digitalFactory;
    public function  __construct(DigitalFactory $digitalFactory )
    {
        $this->digitalFactory = $digitalFactory;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {

    $customer = $observer->getEvent()->getCustomer();
    $this->saveData($customer->getName(), $customer->getEmail());
    exit;
    }

    public function saveData($name, $email, $obs = 'Tomara q de certo'){
        $dc = $this->digitalFactory->create();
        $dc-> setData([
            'author_name'=> $name,
            'email' => $email,
            'description' => $obs,
        ]
        );
        $dc->save();
    }


}
