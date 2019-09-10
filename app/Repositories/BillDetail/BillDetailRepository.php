<?php
    namespace App\Repositories\BillDetail;
    use App\Repositories\BaseRepository;
    use App\BillDetail;
    class BillDetailRepository extends BaseRepository implements BillDetailRepositoryInterface
    {
        public function __construct(BillDetail $billdetail)
        {
            parent::__construct($billdetail);
        }
    }
?>
