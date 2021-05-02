<?php


namespace App\Services;
use App\Customer;
use App\AppLog;
use App\Repositories\Repository;


class CustomerService
{
    protected $customerModel,
              $appLogModel;
   
    public function __construct(
			Customer $customerModel,
			AppLog $appLogModel
		)
    {
        $this->customerModel = new Repository($customerModel);
        $this->appLogModel = new Repository($appLogModel);
    }

    public function getCustomer($customerId)
    {
        return $this->customerModel->show($customerId);
    }

  
    public function createCustomer($data)
    {
        // create record and pass in only fields that are fillable
        $createNewCustomer = $this->customerModel->create($data);
        return $createNewCustomer->customer_id;
    }

    public function updateCustomer($data, $customerId)
    {
        // update record and pass in only fields that are fillable
        $this->customerModel->update($data, $customerId);
    }

  
}
