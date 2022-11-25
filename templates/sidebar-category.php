<div class="axil-shop-sidebar">
    <h3><?php echo LANG_VALUE_49; ?></h3>

                            <div class="d-lg-none">
                                <button class="sidebar-close filter-close-btn"><i class="fas fa-times"></i></button>
                            </div>
                            <?php
                $i=0;
                $statement = $pdo->prepare("SELECT * FROM tbl_top_category WHERE show_on_menu=1");
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($result as $row) {
                    $i++;
                    ?>
                            <div class="toggle-list product-categories active">
                                <h6 class="title"><?php echo $row['tcat_name']; ?></h6>
                                <div class="shop-submenu" style="display:none;">
                                    <ul>
                                        <?php
                           /* $j=0;
                            $statement1 = $pdo->prepare("SELECT * FROM tbl_mid_category WHERE tcat_id=?");
                            $statement1->execute(array($row['tcat_id']));
                            $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result1 as $row1) {
                                $j++;
                                */
                                $k=0;
                                            $statement2 = $pdo->prepare("SELECT * FROM tbl_end_category WHERE mcat_id=?");
                                            $statement2->execute(array($row1['tcat_id']));
                                            $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result2 as $row1) {
                                                $k++;
                                ?>
                                        <li class="">
                                            <div class="toggle-list product-categories active">
                                <h6 >
                                <a href="product-category.php?id=<?php echo $row1['ecat_id']; ?>&type=end-category"> <?php echo $row1['ecat_name']; ?> 
                                            </a>
                                </h6>
                             <!--   <div class="shop-submenu">
                                            
                                            
                                            &nbsp;&nbsp;&nbsp;<ul>
                                                <?php
                                            /*$k=0;
                                            $statement2 = $pdo->prepare("SELECT * FROM tbl_end_category WHERE mcat_id=?");
                                            $statement2->execute(array($row1['mcat_id']));
                                            $result2 = $statement2->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($result2 as $row2) {
                                                $k++;
                                                ?>
                                                <li class="current-cat">
                                                    <a class="" href="product-category.php?id=<?php echo $row2['ecat_id']; ?>&type=end-category">
                                                        <?php echo $row2['ecat_name']; ?>
                                                    </a>
                                                </li>
                                                 <?php
                                            }*/
                                        ?>
                                            </ul>
                                            </div>
                                            -->
                                            </div>
                                            </li>
                                         <?php
                            }
                            ?>
                                    </ul>
                                </div>
                            </div>
                             <?php
                }
            ?>
                           
                        </div>


