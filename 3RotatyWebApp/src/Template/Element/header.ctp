<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;
use App\Controller;
use App\Dto\FindCategoriesDto;
use App\Dto\FindSubcategoryDto;

//$this->layout = 'home_layout';
echo $this->Html->css('/css/sweetalert.css', ['block' => true]);

echo $this->Html->script('jquery.min.js', ['block' => 'scriptTop']);
echo $this->Html->script('bootstrap.min.js', ['block' => 'scriptTop']);
echo $this->Html->script('custom.js', ['block' => 'scriptTop']);
echo $this->Html->script('/js/sweetalert.min.js', ['block' => true]);
echo $this->Html->script('/js/pages/web-header.js', ['block' => true]);
echo $this->Html->script('/js/jquery.validate.js', ['block' => true]);
echo $this->Html->script('/js/validation.subscribe.reg.js', ['block' => true]);
?>
<header>
    <div class="header-top-w3layouts navbar-fixed-top">
        <div class="container">
            <div class="col-md-6 logo-w3">
                <a href="<?= VIRTUAL_DIR_PATH . '/' ?>">

                    <?= $this->Html->image('logo-medium.png', array('alt' => '3Rosaty Logo')); ?>
                </a>
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <?php if (isset($isSubscriberLoggedIn) && $isSubscriberLoggedIn) : ?>
                <div class="col-md-6 header-top-request">
                    <ul>
                        <li class="border-right"><a href="<?= VIRTUAL_DIR_PATH . '/subscribers/portfolio' ?>">My Portfolio</a></li>
                        <li class="border-right"><?= $subscriberName ?></li>
                        <li><a href="<?= VIRTUAL_DIR_PATH . '/HomePage/logout' ?> ">Logout</a></li>
                    </ul>
                </div>
            <?php elseif (isset($isUserLoggedIn) && $isUserLoggedIn) : ?>
                <div class="col-md-6 header-top-request">
                    <ul>
                        <li class="border-right"><a href="<?= VIRTUAL_DIR_PATH . '/subscribers/login' ?>">Partner With Us</a></li>
                        <li class="border-right"><?= $userName ?></li>
                        <li><a href="<?= VIRTUAL_DIR_PATH . '/HomePage/logout' ?> ">Logout</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="col-md-6 header-top-request">
                    <ul>
                        <li class="border-right"><a href="<?= VIRTUAL_DIR_PATH . '/subscribers/login' ?>">Partner With Us</a></li>
                        <li><a href="<?= VIRTUAL_DIR_PATH . '/users/customerlogin' ?>">Login</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="clearfix"></div>
        </div>
        <div class="header-bottom-w3ls">
            <div class="container">
                <div class="col-md-12 navigation-agileits">
                    <nav class="navbar navbar-default">
                        <div class="collapse navbar-collapse page-scroll" id="bs-megadropdown-tabs">
                            <ul class="nav navbar-nav width-100">
                                <li>
                                    <a href="<?= VIRTUAL_DIR_PATH . '/' ?>" class="hyper"  ><span>Home</span></a>
                                </li>
                                <?php
                                if ($eventCategoryList != null) {
                                    $categoryCounter = 0;
                                    foreach ($eventCategoryList as $category) {
                                        $categoryCounter ++;

                                        // echo($values->category);
                                        $isSubcategoryArray = is_array($category->subCategories) && count($category->subCategories) > 0;
                                        ?>
                                        <li  class="dropdown">
                                            <a href="<?= VIRTUAL_DIR_PATH . '/portfolio/' . $category->categoryShortName ?>" class="dropdown-toggle  hyper page-scroll"  ><span><?= $category->category ?>
                                                    <b class="caret"> </b>
                                                </span></a>



                                            <ul class="dropdown-menu multi">
                                                <div class="row">

                                                    <?php
                                                    if ($category->subCategories != null) {
                                                        $totalSubcategoryCount = count($category->subCategories);
                                                        for ($subCategoryCounter = 0; $subCategoryCounter < $totalSubcategoryCount; $subCategoryCounter++) {

                                                            $subCategories = $category->subCategories[$subCategoryCounter];

                                                            if ($subCategoryCounter % 4 == 0) {
                                                                if ($subCategoryCounter != 0) {
                                                                    echo "</ul>";
                                                                    echo "</div >";
                                                                }

                                                                echo "<div class=\"col-sm-4\">";
                                                                echo "<ul class=\"multi-column-dropdown\">";
                                                            }

                                                            if ($subCategoryCounter % 2 != 0) {
                                                                ?>     
                                                                <li><a href="<?= VIRTUAL_DIR_PATH . '/portfolio/' . $category->categoryShortName . '--' . $subCategories->subCategoryShortName ?>" ><?= $subCategories->subCategory ?></a></li>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <li><a href="<?= VIRTUAL_DIR_PATH . '/portfolio/' . $category->categoryShortName . '--' . $subCategories->subCategoryShortName ?>" > <?= $subCategories->subCategory ?></a></li>
                                                                <?php
                                                            }
                                                        }
                                                        echo "</ul>";
                                                        echo "</div >";
                                                    }
                                                    // }
                                                    ?>

                                                    <div class="col-sm-4 w3l">
                                                        <?php if ($categoryCounter == 1) : ?>
                                                            <?= $this->Html->image('services-01.jpg', array('alt' => '', 'class' => 'img-responsive')); ?>
                                                        <?php elseif ($categoryCounter == 2) : ?>
                                                            <?= $this->Html->image('fashion-02.jpg', array('alt' => '', 'class' => 'img-responsive')); ?>
                                                        <?php elseif ($categoryCounter == 3) : ?>
                                                            <?= $this->Html->image('arrangements-03.jpg', array('alt' => '', 'class' => 'img-responsive')); ?>
                                                        <?php elseif ($categoryCounter == 4) : ?>
                                                            <?= $this->Html->image('halls-04.jpg', array('alt' => '', 'class' => 'img-responsive')); ?>
                                                        <?php elseif ($categoryCounter == 5) : ?>
                                                            <?= $this->Html->image('entertainment-05.jpg', array('alt' => '', 'class' => 'img-responsive')); ?>
                                                        <?php else : ?>
                                                            <?= $this->Html->image('entertainment-05.jpg', array('alt' => '', 'class' => 'img-responsive')); ?>
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="clearfix"></div>
                                                </div>

                                            </ul>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                                <?php if (!$isSubscriberLoggedIn && !$isAdminLoggedIn) : ?>
                                    <li class="float-right dropdown no-request">
                                        <a href="" class="dropdown-toggle hyper" data-toggle="dropdown"><span>Special Requests<b class="caret"></b></span></a>
                                        <ul class="dropdown-menu multi multi1 spec_request">
                                            <div class="row">
                                                <form id="spec_form">
                                                    <div class="col-lg-12">
                                                        <div class="form-group"  >
                                                            <label for="spec_email">Name <span class="required_field">*</span>
                                                                <input type="text" id="name" class="form-control valid_name" name="spec_name" required>
                                                                <span class="input-icon"><i class="fa fa-user"></i></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" >
                                                        <div class="form-group">
                                                            <label for="user_email">Email<span class="required_field">*</span>
                                                                <input type="email" id="email" class="form-control valid_email" name="spec_email" required>
                                                                <span class="input-icon"><i class="fa fa-envelope"></i></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" >
                                                        <div class="form-group">
                                                            <label for="mobNo">Mobile No<span class="required_field">*</span>
                                                                <input type="number" id="mobNo" class="form-control valid_mobNo" name="spec_mobile" required="10">
                                                                <span class="input-icon"><i class="fa fa-mobile fa-1-5x"></i></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" >
                                                        <div class="form-group">
                                                            <label for="user_email">Write your request<span class="required_field">*</span>
                                                                <textarea id="spec_msg" class="form-control valid_spec_msg" name="spec_msg" rows=3 required></textarea>
                                                            </label>
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button type="button" title="Submit" id="special_request" name="special_request" class="button black_sm center-block">Submit</button>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </form>
                                            </div>
                                        </ul>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

