<?php
    namespace App\Repositories\Product;
    use App\Repositories\BaseRepository;
    use App\Product;
    class ProductRepository extends BaseRepository implements ProductRepositoryInterface
    {
        public function __construct(Product $product)
        {
            parent::__construct($product);
        }
    }
?>

