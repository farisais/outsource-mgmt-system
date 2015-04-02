<ul class="nav-menu">
<?php 
foreach($topmenu as $tm)
{?>
    <li class='active'><a class="top-menu" href="<?php echo $tm['controller']?>?menu=<?php echo $tm['id_application_menu'] ?>"><span><?php echo $tm['name'] ?></span></a></li>
<?php    
}
?>
</ul>