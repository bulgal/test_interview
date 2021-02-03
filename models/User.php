<?php
namespace Models;
/**
 * Модель пользователя
 */
class User {
    public $active;
    public $blocked;
    public $createdAt;
    public $id;
    public $name;
    public $permissions;
    /**
     * Заполнение модели
     *
     * @param array $userData данные пользователя
     * @return boolean
     */
    public function fillModel(array $userData): bool {
        $this->active = $userData['active'];
        $this->blocked = $userData['blocked'];
        $this->createdAt = $userData['createdAt'];
        $this->id = $userData['id'];
        $this->name = $userData['name'];
        $this->permissions = $userData['permissions'];

        return true;
    }
    /**
     * Получение данных пользователя в виде массива
     *
     * @return array
     */
    public function getUserAsArray(): array {
        foreach (get_class_vars(__CLASS__) as $name => $value) {
            $user[$name] = $value;
        }
        return $user;
    }
}