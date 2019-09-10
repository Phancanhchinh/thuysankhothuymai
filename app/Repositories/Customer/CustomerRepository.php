<?php
    namespace App\Repositories\Customer;
    use App\Repositories\BaseRepository;
    use App\Customer;
    class CustomerRepository extends BaseRepository implements CustomerRepositoryInterface
    {
        public function __construct(Customer $customer)
        {
            parent::__construct($customer);
        }
    }
?>
