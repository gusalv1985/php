Vue.component('peticion-asincronica', {
    props:[],
  data: function() {
    return {
        calle:"",
        altura:"", 
        numero:[0,0,0,0,0],
        valores:[],
        
        enviado: false
    }
  },
  methods: {
    
    mostrar: function() {
        // let numero = []
        //  numero[0] = document.getElementById("1")
        //  numero[1] = document.getElementById("2")
        //  numero[2] = document.getElementById("3")
        //  numero[3] = document.getElementById("4")
        //  numero[4] = document.getElementById("5")

         /* los datos del input number los tuve que traer por id
        ya que si utilizaba en v-model al igual que con los checkbox
        se comportaba todo el array de inputs como uno solo 
        y devolvia un solo numero, para individualizarlo tuve que
        tomar los datos de esta manera. */
     
       // console.log(numero[0].value);
        // let count = 0
        // numero.forEach(e => {
        //   if (e.value != "") {
        //     if (e.value == 0) {
        //       count--
        //     }
        //     count++
        //   } 
        // });
        // console.log(count)

        console.log(this.calle);
        console.log(this.altura);
        console.log(this.valores)
        console.log(this.numero)
      
        var error='';

        var pat_calle=/^[a-z0-9\sñáéíóú°/.']{1,40}$/i;
      	var pat_altura=/^\d{1,5}$/i;
      	if(!pat_calle.test(this.calle)){
           // console.log("Complete el usuario");		
            error+="<b>revise el campo calle</b><BR>";
          }
          if(!pat_altura.test(this.altura)){
            //console.log("Complete el password");		
            error+="<b>altura, solo numeros</b><BR>";
          }
        
          
          this.$refs['error'].innerHTML=error;

        if(error.length>0){
          return;
        }

        if(this.valores.length == 0){
          alert("no selecciono productos")
          return
        }

        // if (this.valores.length != count) {
        //   alert("si selecciono algun producto por error, no lo tilde y seleccione cantidad 0")
        //   return
        // }

        var action=this.$refs.form.action;
        var datos=new FormData();
        datos.append('calle',this.calle);
        datos.append('altura', this.altura)

        if (this.numero[0].value != 0) {
          datos.append('number[0]',this.numero[0]);
        }
        if (this.numero[1].value != 0) {
          datos.append('number[1]',this.numero[1]);
        }
        if (this.numero[2].value != 0) {
          datos.append('number[2]',this.numero[2]);
        }
        if (this.numero[3].value != 0) {
          datos.append('number[3]',this.numero[3]);
        }
        if (this.numero[4].value != 0) {
          datos.append('number[4]',this.numero[4]);
        }

        //datos.append('number[]', this.number);

        /*el array de valores llegaba plano a articulos procesar_Ok
        por eso tuve que llevarlos como individuales.
        ademas que no encontre como pasarlo por un bucle ya que 
        el valor entre comillas no puede variar con un contador i */

        if (this.valores[0] != null) {
          datos.append('valores[0]',this.valores[0]);
        }
        if (this.valores[1] != null) {
          datos.append('valores[1]',this.valores[1]);
        }
        if (this.valores[2] != null) {
          datos.append('valores[2]',this.valores[2]);
        }
        if (this.valores[3] != null) {
          datos.append('valores[3]',this.valores[3]);
        }
        if (this.valores[4] != null) {
          datos.append('valores[4]',this.valores[4]);
        }
       


       
       // datos.append('valores[2]', this.valores[2]);
       // datos.append('valores[3]', this.valores[3]);
       // datos.append('valores[4]', this.valores[4]);
      //  console.log(action);
       // console.log(datos);
        this.$http.post(action,datos)
        .then(
          response => {
  
              // ok callback
                // console.log(response.bodyText);
               
                var auxiliar=response.data;
                this.enviado=true;
              //  console.log(auxiliar.mensaje)
                this.$refs['mensaje'].innerHTML=response.bodyText;
            	 	
            	
            }, response => {
            // error callback
              alert("Error en el servidor");
            }
          );
         // error='';
		
    },
    borrar: function() {
        console.log("Borrando elementos");
    }      
  }
});

var app = new Vue({
  el:'#aplicacion',
  data: {
  },
  methods:{

  }
})