<?php

namespace App\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        
        $newSubmenu = $menu
            ->addChild('monsieur-geek')
            ->setLabel('app.ui.monsieur_geek')
        ;
        
        $newSubmenu
            ->addChild('editors', ['route' => 'app_admin_editor_index'])
            ->setLabelAttribute('icon', 'id badge')
            ->setLabel('app.ui.editors')
        ;
    }
}
