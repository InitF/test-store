<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->getIdentity()->username ?? 'Guest'  ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Users', 'url' => ['/user'], 'visible' => Yii::$app->user->can('adminMenu')],
                    ['label' => 'RBAC', 'visible' => Yii::$app->user->can('adminMenu'),
                        'items' => [
                            ['label' => 'Rule', 'url' => ['/rbac/rule']],
                            ['label' => 'Permission', 'url' => ['/rbac/permission']],
                            ['label' => 'Role', 'url' => ['/rbac/role']],
                            ['label' => 'Assigment', 'url' => ['/rbac/assignment']],
                        ]
                    ],
                    ['label' => 'Products', 'url' => ['/products']],
                    ['label' => 'Categories', 'url' => ['/tree']],
                    ['label' => 'Tags', 'url' => ['/tags']],
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Gii', 'icon' => 'fa fa-file-code-o', 'url' => ['/gii']],
                    ['label' => 'Debug', 'icon' => 'fa fa-dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                ],
            ]
        ) ?>

    </section>

</aside>
