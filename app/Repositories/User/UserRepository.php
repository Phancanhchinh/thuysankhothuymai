<?php
    namespace App\Repositories\User;
    use App\Repositories\BaseRepository;
    use App\User;
    class UserRepository extends BaseRepository implements UserRepositoryInterface
    {
        public function __construct(User $user)
        {
            parent::__construct($user);
        }
    }
?>
