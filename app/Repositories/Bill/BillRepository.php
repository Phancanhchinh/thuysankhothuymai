<?php
    namespace App\Repositories\Bill;
    use App\Repositories\BaseRepository;
    use App\Bill;
    class BillRepository extends BaseRepository implements BillRepositoryInterface
    {
        public function __construct(Bill $bill)
        {
            parent::__construct($bill);
        }
    }
?>
