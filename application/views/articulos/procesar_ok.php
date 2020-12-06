<script src="<?echo base_url();?>js/compo_procesar_art.js" defer></script>
<div id="aplicacion">
  <peticion-asincronica inline-template>
    <div>
        <p>su pedido a sido tomado con exito😊</p>
        <tr>
        <?
        $destino = 'articulos/verPedido';
        $event='$event';
        $atributo="v-on:click.prevent='mostrar($event)' class='btn btn-Primary'";
        echo anchor($destino,'Ver Pedido',$atributo);
        echo "<BR>";
        echo "<BR>";
        $destino = 'articulos/articulosTodos';
        $atributo="class='btn btn-info'";
        echo anchor($destino,'Hacer otro pedido',$atributo);
        echo "<BR>";
        echo "<BR>";
        $destino = 'usuarios/salir';
        $atributo="class='btn btn-secondary'";
        echo anchor($destino,'Salir',$atributo);
        echo "<BR>";
        echo "<BR>";
        ?>
        </tr>
        <div ref="dato">
        
        </div>
        
	</div>
  </peticion-asincronica>
</div>
