<?php
namespace Api;
include './vendor/autoload';

use Exception;
use GuzzleHttp\Client;
use Models\User;
/**
 * Работа с апи пользователей
 */
class TestApi {
    /**
     * Токен авторизации
     */
    private string $token;

    private Client $client;

    public function __construct(): void {
        $config = include './config/api.php';
        $this->auth($config['url'], $config['user'], $config['password']);
    }
    /**
     * Авторизация в сервисе
     *
     * @param string $url адрес сервиса
     * @param string $user имя пользователя
     * @param string $pass пароль пользователя
     * @return void
     */
    private function auth(string $url, string $user, string $pass): void {
        $this->client = new Client(['base_uri' => $url]);

        $res = $this->client->request('GET', 'auth', [
            'auth' => [$user, $pass]
        ]);
        $data = json_decode($res->getBody());

        if (!$data['token']) {
            throw new Exception('Не удалось получить токен');
        }

        $this->token = $data['token'];
    }
    /**
     * Получение пользователя
     *
     * @param string $username имя пользователя
     * @return User|null
     */
    public function getUser(string $username): ?User {
        $res = $this->client->request('GET', "get-user/$username", [
            'query' => ['token' => $this->token]
        ]);

        if ($res->getStatusCode() === 200) {
            return null;
        } else {
            $body = $res->getBody();

            $user = new User;
            $user->fillModel(json_decode($body));
            return $user;
        }
    }
    /**
     * Обновление данных пользователя
     *
     * @param User $user пользователь
     * @return boolean
     */
    public function updateUser(User $user): bool {
        $res = $this->client->request('POST', "user/$user->id/update", [
            'query' => ['token' => $this->token],
            'form_params' => $user->getUserAsArray()
        ]);

        if ($res->getStatusCode() === 200) {
            return true;
        } else {
            return false;
        }
    }

}