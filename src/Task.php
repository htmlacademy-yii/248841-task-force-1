<?php

namespace Lobochkin\TaskForce;

use Lobochkin\TaskForce\{Answer, Cancel, Decline, Exception\ValidValueException, Finished};

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

    const EXPIRED = 'expired'; // Для вкладки просроченные в моих заданиях

    const ROLE_IMPLEMENT = 'implementer'; // Исполнитель
    const ROLE_CUSTOMER = 'customer'; // Заказчик
    const STATUS_NAME = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_IN_WORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAILED => 'Провалено',
        self::STATUS_CANCEL => 'Отменено',
    ];
    const ACTION_NAME = [
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
        ],
        self::STATUS_IN_WORK => [
            Decline::class,
            Finished::class,
        ]
    ];

    protected $idTask = null;
    protected $idStatus = null;

    /**
     * @param string $action
     * @return string|null
     * @throws ValidValueException
     */
    public function getNextStatus(string $action): string
    {

        if (!self::ACTION_NAME[$action]) {
            throw new ValidValueException("Нет действия: {$action}!");
        }

        return self::NEXT_STATUS[$action];
    }

    /**
     * метод получения действий для статуса
     * @param string $status
     * @param int|null $idImplement
     * @param int $idEmployer
     * @param int $idUser
     * @return array массив объектов действий
     * @throws ValidValueException
     */
    public static function getNextAction(string $status, $idImplement, int $idEmployer, int $idUser): ?array
    {

        if (!self::STATUS_NAME[$status]) {
            throw new ValidValueException("Нет статуса: {$status}!");
        }

        return array_filter(self::NEXT_ACTION[$status], function ($obAction) use ($idImplement, $idEmployer, $idUser) {
            return call_user_func_array([$obAction, 'checkingRights'], [$idImplement, $idEmployer, $idUser]);
        });
    }
}

