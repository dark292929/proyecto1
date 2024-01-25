<div class="login-box">
    <div class="login-logo">
       <b>Sistema Avicola</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">


        <form method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" name="usuario" placeholder="usuario">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">

                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                </div>
                <!-- /.col -->
            </div>
            <?php 


$login=ControladorUsuarios::ctrIngresoUsuario();


?>

        </form>


    </div>
    <!-- /.login-box-body -->
</div>