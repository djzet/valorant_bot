<?php

namespace App\Handlers;

use App\Models\Agents;
use App\Models\Maps;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Stringable;

class Telegram extends WebhookHandler
{
    public Agents $agents;
    public Maps $maps;

    public function __construct(Agents $agents, Maps $maps)
    {
        parent::__construct();
        $this->agents = $agents;
        $this->maps = $maps;
    }

    public function start()
    {
        $this->chat->message('<b>Добро пожаловать в телеграм бот "Valorant"!</b>
Если ты не знаешь за кого сегодня поиграть
то этот бот тебе поможет!
Для большей информации наберите команду /help')->send();
    }

    public function help()
    {
        $this->chat->message('Список доступных команд:
/start - Начало работы
/help - Список команд
/agents - Список агентов
/maps - Список карт
')->send();
    }

    public function maps()
    {
        $maps = $this->maps->getMaps()->all();
        $this->chat->html(view('valorant.maps', ['maps' => $maps]))->send();

    }

    public function agents()
    {
        $agents = $this->agents->getAgents()->all();
        $this->chat->html(view('valorant.agents', ['agents' => $agents]))->send();

    }

    public function rand_agent($text)
    {
        preg_match_all('/\d+/', $text, $matches);
        if (empty($matches[0])) {
            $this->chat->message('Повторите попытку')->send();
        } else {
            $numbers = $matches;
            $number_rand = array_rand($numbers[0]);
            $agent_rand = $numbers[0][$number_rand];
            $agents = $this->agents->getAgents()->all();
            foreach ($agents as $agent) {
                if ($agent->id == $agent_rand) {
                    $this->chat->html(view('valorant.agent_rand', ['agent' => $agent->name]))->send();
                }
            }
        }
    }


    public function rand_map($text)
    {
        preg_match_all('/\d+/', $text, $matches);
        if (empty($matches[0])) {
            $this->chat->message('Повторите попытку')->send();
        } else {
            $numbers = $matches;
            $number_rand = array_rand($numbers[0]);
            $map_rand = $numbers[0][$number_rand];
            $mapss = $this->maps->getMaps()->all();
            foreach ($mapss as $maps) {
                if ($maps->id == $map_rand) {
                    $this->chat->html(view('valorant.map_rand', ['maps' => $maps->name]))->send();
                }
            }
        }
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        $this->chat->message('Неизвестная команда, воспользуйтесь /help')->send();
    }
}
