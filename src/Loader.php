<?php

declare(strict_types=1);

namespace skh6075\CobblestoneMine;

use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BaseBlockChangeEvent;
use pocketmine\event\block\BlockFormEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use ReflectionProperty;

final class Loader extends PluginBase implements Listener{
	protected function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	/** @priority HIGHEST */
	public function onBlockFormEvent(BlockFormEvent $event) : void{
		static $prop = null;
		if($prop === null){
			$prop = new ReflectionProperty(BaseBlockChangeEvent::class, "newState");
			$prop->setAccessible(true);
		}

		if(!$event->isCancelled() && $event->getBlock()->isSameType(VanillaBlocks::LAVA())){
			$newStateBlock = null;
			while($newStateBlock === null){
				if(random_int(0, 1)){
					$newStateBlock = VanillaBlocks::COBBLESTONE();
				}else if(random_int(1, 100) <= 20){
					$newStateBlock = VanillaBlocks::COAL_ORE();
				}else if(random_int(1, 100) <= 10){
					$newStateBlock = VanillaBlocks::IRON_ORE();
				}else if(random_int(1, 100) <= 8){
					$newStateBlock = VanillaBlocks::GOLD_ORE();
				}else if(random_int(1, 100) <= 5){
					$newStateBlock = VanillaBlocks::REDSTONE_ORE();
				}else if(random_int(1, 100) <= 5){
					$newStateBlock = VanillaBlocks::REDSTONE_ORE();
				}else if(random_int(1, 100) <= 1){
					$newStateBlock = VanillaBlocks::DIAMOND_ORE();
				}else if(random_int(1, 150) <= 1){
					$newStateBlock = VanillaBlocks::EMERALD_ORE();
				}
			}
			$prop->setValue($event, $newStateBlock);
		}
	}
}