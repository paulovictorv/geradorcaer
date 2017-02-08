<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="<?php echo site_url('img/certificate-icon');?>" />
    <title> Meu Certificado </title>
    <link href="<?php echo site_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/dist/css/sb-admin-2.css'); ?>" rel="stylesheet">
    <link href="<?php echo site_url('assets/vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
</head>

<body>
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= site_url('home'); ?>"><i class="fa fa-wpforms" aria-hidden="true"></i> Meu Certificado</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?= $usuario["nome_usuario"]?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?= site_url('visualizar-perfil'); ?>"><i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?= site_url('fazer-logoff'); ?>"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?php if($usuario["tipo_usuario"] == 1 || $usuario["tipo_usuario"] == 2): ?>
                        <li class="active">
                            <a href="javascript:;"><i class="fa fa-calendar" aria-hidden="true"></i> Eventos <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= site_url('novo-evento'); ?>"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> Criar Evento</a>
                                </li>
                                <li>
                                    <a href="<?= site_url('eventos-encerrados'); ?>"><i class="fa fa-calendar-times-o" aria-hidden="true"></i> Eventos Encerrados </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user-secret" aria-hidden="true"></i> Responsáveis <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">                                <li>
                                    <a href="<?= site_url('listar-responsaveis'); ?>"><i class="fa fa-cog" aria-hidden="true"></i> Gerenciar</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users" aria-hidden="true"></i> Usuários<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?= site_url('listar-usuarios'); ?>"><i class="fa fa-cog" aria-hidden="true"></i> Gerenciar</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <?php endif ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
</body>
</html>
