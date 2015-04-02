
<?php
$prevMenu = '';
$menu = $class->get_child_menu_from_id($top_menu) ;
$countRow = count($menu);
$i = 0;

$menuPrint = '<ul>';

foreach($menu as $sm)
{
    

    if($sm['type'] == 'group')
    {
        if($prevMenu != '')
        {
            if($sm['parent'] != $prevMenu['id_application_menu'])
            {
                $menuPrint .= '</li></ul>';
            }   
        }    
        $menuPrint .= '<li class="menu-group"><a href="#"><span>' . $sm['name'] . '</span></a>';
        $menuPrint .= '<ul class="menu-child">';

    }
    else
    {
        $menuPrint .= '<li id="smenu-'. $sm['id_application_menu'] .'" class="sub-menu"><a href="' . base_url() . $controller . '?action=' . $sm['action'] .'"><input type="hidden" value="'. $sm['action'] . '" /><span>'. $sm['name'] . '</span></a></li>';
    }
    $prevMenu = $sm;
    $i++;
    if($i == $countRow)
    {
        if($prevMenu['type'] == 'group')
        {
            $menuPrint .= '</li></ul>';
        }   
    }
}
$menuPrint .= '</ul>';
echo $menuPrint;
?>