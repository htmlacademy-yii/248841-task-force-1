<?php


namespace Lobochkin\TaskForce;


class Answer extends Action
{
    protected $name = 'Откликнуться';
    protected $innerName = 'answer';

    /**
     * @param int $idImplement
     * @param int $idCustomer
     * @param int $idUser
     * @return bool
     * @inheritDoc
     */
    public function checkingRights(int $idImplement, int $idCustomer, int $idUser): bool
    {
        return $idImplement === $idUser;
    }
}
