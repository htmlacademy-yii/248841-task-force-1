<?php

namespace Lobochkin\TaskForce;

use Lobochkin\TaskForce\{
    Answer,
    Cancel,
    Decline,
    Finished
};

/** Класс для управления действиями(кнопками) и статусами
 * Class Task
 * @package TaskForce
 */
class Task
{
    // Стастусы задания
    const STATUS_NEW = 'new'; // Новое
    const STATUS_IN_WORK = 'in_work'; // В работе
    const STATUS_DONE = 'done'; // Выполнено
    const STATUS_FAILED = 'failed'; // Провалено
    const STATUS_CANCEL = 'cancel'; // Отменено
    // Действия с заданием
    const ACTION_CANCEL = 'cancel'; // Отменить задание( Заказчик)
    const ACTION_ANSWER = 'answer'; // Откликнуться на задание(Исполнитель)
    const ACTION_FINISHED = 'finished'; //  Задание выполнено(Заказчик)
    const ACTION_DECLINE = 'decline'; // Отказаться от задания(Исполнитель)
    const ACTION_ACCEPT = 'accept'; // Принять отклик от исполнителя(Заказчик)

    const ROLE_IMPLEMENT = 'implementer'; // Исполнитель
    const ROLE_CUSTOMER = 'customer'; // Заказчик
    protected $statusNames = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_IN_WORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAILED => 'Провалено',
        self::STATUS_CANCEL => 'Отменено',
    ];
    protected $actionNames = [
        self::ACTION_CANCEL => 'Отменить',
        self::ACTION_ANSWER => 'Откликнуться',
        self::ACTION_FINISHED => 'Выполнено',
        self::ACTION_DECLINE => 'Отказаться',
        self::ACTION_ACCEPT => 'Принять'
    ];

    const NEXT_STATUS = [
        self::ACTION_CANCEL => self::STATUS_CANCEL,
        self::ACTION_FINISHED => self::STATUS_DONE,
        self::ACTION_DECLINE => self::STATUS_FAILED,
        self::ACTION_ACCEPT => self::STATUS_IN_WORK,
    ];
    const NEXT_ACTION = [
        self::STATUS_NEW => [
            Answer::class,
            Cancel::class,
            Accept::class
        ],
        self::STATUS_IN_WORK => [
            Decline::class,
            Finished::class,
        ]
    ];

    protected $idTask = null;
    protected $idStatus = null;

    public function __construct(int $idTask, int $idStatus)
    {
        $this->idTask = $idTask;
        $this->idStatus = $idStatus;
    }

    /**
     * @param string $action
     * @return string|null
     */
    public function getNextStatus(string $action)
    {
        if (!$action) {
            return null;
        }
        return self::NEXT_STATUS[$action];
    }

    /**
     * метод получения действий для статуса
     * @param string $status
     * @param int $idImplement
     * @param int $idCustomer
     * @param int $idUser
     * @return array массив объектов действий
     */
    public function getNextAction(string $status, int $idImplement, int $idCustomer, int $idUser)
    {
        $arOb = [];
        foreach (self::NEXT_ACTION[$status] as $ob) {
            if (call_user_func_array([$ob, 'checkingRights'], [$idImplement, $idCustomer, $idUser])) {
                $arOb[] = $ob;
            }
        }

        return $arOb;
    }
}

