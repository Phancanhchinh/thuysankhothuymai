<?php
    namespace App\Repositories\TypeProduct;
    use App\Repositories\BaseRepository;
    use App\TypeProduct;
    class TypeProductRepository extends BaseRepository implements TypeProductRepositoryInterface
    {
        public function __construct(TypeProduct $type)
        {
            parent::__construct($type);
        }
    }
?>
