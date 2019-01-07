<?php
use app\models\User;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <!-- <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/> -->
                    <?php if (User::isAdmin()): ?>
                           <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>        <?php endif ?>
                    <?php if (User::isAnggota()): ?>
                           <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>        <?php endif ?>
                       <?php if (User::isPetugas()): ?>
                           <?= User::getFotoPetugas(['class' => 'img-circle']); ?>
                       <?php endif ?>
            </div>
            <div class="pull-left info">
                <!-- untuk menentukan siapa yg login -->
                <p><?= Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- mengecek login -->
        <?php if (User::isAdmin()) { ?>
            <?= dmstr\Widgets\Menu::widget (
            ) ?>
        <?php } elseif (User::isAnggota()) { ?>
            
        <?= dmstr\Widgets\Menu::widget(
        ) ?> 
        <?php } ?>

        <!-- Navigasi Admin -->
        <?php if (Yii::$app->user->identity->id_user_role == 1): ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu', 'options' => ['class' => 'header']],
                    ['label' => 'Home', 'icon' => 'home', 'url' => ['site/dashboard']],
                    ['label' => 'Menu Utama', 'options' => ['class' => 'header']],
                    ['label' => 'Buku', 'icon' => 'book', 'url' => ['buku/index']],
                    ['label' => 'Kategori', 'icon' => 'server', 'url' => ['kategori/index']],
                    ['label' => 'Penerbit', 'icon' => 'building', 'url' => ['penerbit/index']],
                    ['label' => 'Penulis', 'icon' => ' fa-clone', 'url' => ['penulis/index']],
                    ['label' => 'Peminjaman', 'icon' => 'calendar-o', 'url' => ['peminjaman/index']],
                    ['label' => 'Anggota', 'icon' => 'users', 'url' => ['anggota/index']],
                    ['label' => 'Petugas', 'icon' => 'user', 'url' => ['petugas/index']],
                    ['label' => 'user', 'icon' => 'child', 'url' => ['user/index']],
                    // ['label' => 'Sign Out', 'icon' => 'sign-out', 'url' => ['/site/logout']], 

                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>
    <?php endif ?>
    <!-- mengecek login -->
        <?php if (User::isAnggota()) { ?>
            <?= dmstr\Widgets\Menu::widget (
            ) ?>
        <?php } elseif (User::isPetugas()) { ?>
            
        <?= dmstr\Widgets\Menu::widget(
        ) ?> 
        <?php } ?>
     <!-- Navigasi Anggota -->
    <?php if (Yii::$app->user->identity->id_user_role == 2): ?>
        <?= dmstr\widgets\Menu::widget(
            [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        //['label' => 'Rumah', 'icon' => 'home', 'url' => ['site/index'],],
                        ['label' => 'Home', 'icon' => 'home', 'url' => ['site/dashboard'],],
                        ['label' => 'Menu Buku', 'options' => ['class' => 'header']],
                        ['label' => 'Peminjaman', 'icon' => 'calendar-o', 'url' => ['peminjaman/index'],],
                    ],
            ]
        ) ?>
    <?php endif ?>
    <!-- mengecek login -->
        <?php if (User::isPetugas()) { ?>
            <?= dmstr\Widgets\Menu::widget (
            ) ?>
        <?php } elseif (User::isAdmin()) { ?>
            
        <?= dmstr\Widgets\Menu::widget(
        ) ?> 
        <?php } ?>
    <!-- Navigasi Petugas -->
    <?php if (Yii::$app->user->identity->id_user_role == 3): ?>
        <?= dmstr\widgets\Menu::widget(
            [
                    'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                    'items' => [
                        //['label' => 'Rumah', 'icon' => 'home', 'url' => ['site/index'],],
                        ['label' => 'Home', 'icon' => 'home', 'url' => ['site/dashboard'],],
                        ['label' => 'Menu Buku', 'options' => ['class' => 'header']],
                        [
                            'label' => 'Buku',
                            'icon' => 'book',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Buku', 'icon' => 'book', 'url' => ['buku/index'],],
                                ['label' => 'Kategori', 'icon' => 'server', 'url' => ['kategori/index'],],
                                ['label' => 'Penerbit', 'icon' => 'building', 'url' => ['penerbit/index'],],
                                ['label' => 'Penulis', 'icon' => 'user', 'url' => ['penulis/index'],],
                                ['label' => 'Peminjaman', 'icon' => 'calendar-o', 'url' => ['peminjaman/index'],],
                            ],
                        ],
                        ['label' => 'Menu Pengguna', 'options' => ['class' => 'header']],
                        ['label' => 'Anggota', 'icon' => 'user', 'url' => ['anggota/index'],],
                        
                    ],
            ]
        ) ?>
    <?php endif ?>

    </section>

</aside>
