<?php

declare(strict_types=1);

namespace QuickLagClear;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\world\World;
use pocketmine\entity\object\ItemEntity;
use pocketmine\entity\projectile\Arrow;

class Main extends PluginBase
{
    /** @var bool */
    private bool $autoOptimize;

    /** @var int */
    private int $interval;

    public function onEnable(): void
    {
        $this->saveDefaultConfig();
        $this->autoOptimize = $this->getConfig()->get("auto_optimize", true);
        $this->interval = (int)$this->getConfig()->get("interval", 300);

        if ($this->autoOptimize) {
            $this->getScheduler()->scheduleRepeatingTask(new ClosureTask(function (): void {
                $this->runOptimization();
            }), $this->interval * 20); // Convert seconds to ticks (1 sec = 20 ticks)
        }

        $this->getLogger()->info("QuickLagClear enabled. Auto-optimize: " . ($this->autoOptimize ? "Enabled" : "Disabled") . ", Interval: {$this->interval} seconds.");
    }

    private function runOptimization(): void
    {
        $this->getLogger()->info("Starting server optimization...");

        foreach ($this->getServer()->getWorldManager()->getWorlds() as $world) {
            $this->clearEntities($world);
        }

        $this->getLogger()->info("Server optimization completed successfully.");
    }

    private function clearEntities(World $world): void
    {
        $removedItems = 0;
        $removedArrows = 0;

        foreach ($world->getEntities() as $entity) {
            if ($entity instanceof ItemEntity) {
                $entity->flagForDespawn();
                $removedItems++;
            } elseif ($entity instanceof Arrow) {
                $entity->flagForDespawn();
                $removedArrows++;
            }
        }

        $this->getLogger()->info("World '{$world->getFolderName()}' optimized: {$removedItems} items and {$removedArrows} arrows removed.");
    }
}