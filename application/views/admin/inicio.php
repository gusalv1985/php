<script src="<?echo base_url();?>js/compo_admin.js" defer></script>
<div id="aplicacion">
  <peticion-asincronica inline-template>
    <div class="caja">
      <?
      echo validation_errors();
      echo form_open('admin/actualizar_ok',"v-on:submit.prevent='mostrar'  ref='form'");
        echo form_fieldset("soy admin"); ?>
          <P style="font-weight: bold; color:black;  font-size:20px">Nuestros articulos</p>
        <table id="tabla" class="table table-hover" border="1">
        <thead  class="thead-dark">
              <th></th>
              <th>descripcion</th>
              <th>precio $</th>
              </thead>
              <?$i=0;?>
              <?php foreach ($articulos as $articulo) : ?>
                  <tr>
                      <?
                      echo "<td>"."<input type=checkbox name=valores[] value='$articulo[id]' v-model='valores'/>"."</td>";
                      echo "<td>"."<input type=text name=producto[] value='$articulo[descripcion]' v-model='producto[$i]'/>"."</td>";
                      echo "<td>"."<input type=text name=precio value='$articulo[precio]' v-model='precio[$i]'/>"."</td>";
                      ?>
                  </tr>
                  <?$i = $i+1;?>
              <?php endforeach ?>
          </table>
          <div ref="error"></div>
          <?
           $data=array(
            'type'=> 'submit',
            'class'=> 'btn btn-danger botones',
          );
          echo form_submit($data,'Enviar');
         
          echo	"<p>" ; echo $archivo ;"</p>"; 
        
           $atributo="class='btn btn-danger'";
            echo	"<p>Descuento: "; echo anchor('admin/activar', 'Activar/',$atributo); echo anchor('admin/desactivar', 'Desactivar',$atributo);"</p>";
          echo	"<p></p>";
            
         
      echo form_close("<BR>");?>
      <p><?$atributo="class='btn btn-info boton'"; echo anchor('usuarios/salir','Salir',$atributo) ?></p>
      <?php echo form_fieldset_close();
      ?>
     
      
      
    </div>  
  </peticion-asincronica>
</div>