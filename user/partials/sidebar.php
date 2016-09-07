<div class="profile-image">
    <div class="img-holder" style="border:0;">
      <?php
        if($cv->get_profilna() == 0){
          if($cv->get_spol() == 2) echo '<img style="width:38px;opacity:0.9;" src="'.$url_home.'icons/zensko-b.png" />';
            else echo '<img style="width:38px;opacity:0.9;" src="'.$url_home.'icons/musko-b.png" />';

        }else{
          echo '<img src="https://scontent-vie1-1.xx.fbcdn.net/hphotos-xtf1/v/t1.0-9/11828697_10207716111890840_6605429353789010748_n.jpg?oh=c8a5efec44e1bb9620beba871121284a&oe=563DE542" />';
        }
      ?>
    </div>
</div>

<a href="<?=$url_home;?>user" class="sidebar-element">  <i class="icon home-icon"></i> <p class="hidden-info">Home</p>  <div style="clear:both;"></div></a>
<a href="<?=$url_home;?>user/cv.php" class="sidebar-element">  <i class="icon edit-icon"></i> <p class="hidden-info">Edit CV </p> <div style="clear:both;"></div></a>
<a href="<?=$url_home;?>user/moj-cv.php" class="sidebar-element">  <i class="icon overview-icon"></i> <p class="hidden-info">Moj CV</p> <div style="clear:both;"></div></a>
<a href="<?=$url_home;?>user/logout.php" class="sidebar-element">  <i class="icon logout-icon"></i> <p class="hidden-info">Logout</p> <div style="clear:both;"></div></a>
