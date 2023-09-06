<?php
namespace CommandFixed\Jorgebyte;

use pocketmine\event\Listener;
use pocketmine\event\server\CommandEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as JB;

class Main extends PluginBase implements Listener
{
    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);

        $this->saveDefaultConfig();
    }

    public function onCommandEvent(CommandEvent $event) {
        $command = $event->getCommand();

        if (preg_match('/["\s]/', $command)) {
            $sender = $event->getSender();
            $message = $this->getConfig()->get("error-message");
            $sender->sendMessage(JB::colorize($message));
            $event->cancel();
        }
    }
}
