 <?php
    $isLoged = (isset($_SESSION["user"]) and $_SESSION["user"]["role"] == "super_admin") ?? null;
    ?>
 <div class="nav_bar_section">
     <div class="nav_bar_content">
         <div class="nav_bar">
             <div class="nav_bar_title">
                 <div class="title"> <a href="/administration">DASHBORD</a></div>
             </div>
             <div class="nav_childs_container">

                 <div>
                     <select class="nav_child" name="" id="">
                         <option selected id="categorie_option_exemple"><a href="/articles">categories</a></option>
                         <?php foreach ($categories as $key => $categorie) { ?>
                             <option value=""><a href="/categorie/<?= $categorie->getId() ?>"> <?= $categorie->getName() ?>
                                 </a>
                             </option>
                         <?php  } ?>
                     </select>
                 </div>

                 <div class="nav_child">
                     <a href="/administration/add-article">Ajouter un article</a>
                 </div>

                 <div class="nav_child">
                     <a href="/administration/add-categorie">Ajouter une categorie</a>
                 </div>



                 <?php if ($isLoged) {  ?>
                     <div class="nav_child">
                         <a href="/administration/add-admin">Ajouter un Admin</a>
                     </div>
                 <?php }  ?>

                 <div class="nav_child">
                     <a href="/administration/add-article">administrateurs</a>
                 </div>
             </div>
         </div>
     </div>
 </div>
