<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 class="text-dark" style="font-size: 36px;">
            ¡Bienvenido al Sistema!
        </h1>
        <h1 class="text-dark" style="font-size: 36px;">
            ROL<p><?php echo $_SESSION["rol"]; ?></p>
        </h1>
        <h1 class="text-dark" style="font-size: 36px;">
          SEDE  <p><?php echo $_SESSION["categoriasede"]; ?></p>
        </h1>
        <h1 class="text-dark" style="font-size: 36px;">
          PERFIL  <p><?php echo $_SESSION["perfil"]; ?></p>
        </h1>
        <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i> Home</a></li>
            <li>Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <?php

            // include "inicio/cajar-superiores.php";

            ?>


        </div>

        <div class="row">

            <div class="col-lg-12">

                <?php

                //  include "reportes/grafico-ventas.php";


                ?>

            </div>

            <div class="col-lg-6">

                <?php

                //  include "reportes/productos-mas-vendidos.php";


                ?>

            </div>

            <div class="col-lg-6">

                <?php

                //  include "inicio/productos-recientes.php";


                ?>

            </div>



        </div>


</div>

<style>
    .text-dark {
        color: #333;
        font-weight: bold;
    }
</style>

</section>
<!-- /.content -->
</div>