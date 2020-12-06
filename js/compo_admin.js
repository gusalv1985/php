Vue.component('peticion-asincronica', {
    props:[],
  data: function() {
    return {
        precio:[49.89,73.89,222,162.9,399.91], 
        producto:['Alcohol 1L',
        'LAVANDINA 2L',
        'SANITIZANTE REFRESH 250 CC',
        'JABON LIQUIDO 250 CC',
        'BARBIJO x10 un.'],
        valores:[],
        
        enviado: false
    }
  },
  methods: {
    
    mostrar: function() {
  
        console.log(this.precio);
        console.log(this.producto)
        console.log(parseInt(this.valores[0]-1));
        console.log(this.valores);
     
        var pat_producto=/^[a-z0-9._\s]{3,30}$/i;
        var pat_precio=/^[0-9]{1,4}([,.][0-9]{1,2})?$/i;
        var error='';
        let product;
        let price;
        let i = 0;
        let j = 0

        for ( i ; i < this.valores.length; i++) {
         product = this.producto[parseInt(this.valores[i]-1)] 
          if(!pat_producto.test(product)){	
            error+="<b>la descripcion no cumple con el patron</b><BR>";
          }
        }

        for ( j ; j < this.valores.length; j++) {
         price = this.precio[parseInt(this.valores[j]-1)]
         if(!pat_precio.test(price)){		
          error+="<b>precio no cumple con el patron</b><BR>";
          }
        }
         

          
          this.$refs['error'].innerHTML=error;

        if(error.length>0){
          return;
        }

        if(this.valores.length == 0){
          alert("no selecciono productos")
          return
        }


        var action=this.$refs.form.action;
        var datos=new FormData();
        datos.append('valores',JSON.stringify(this.valores));
        datos.append('producto', JSON.stringify(this.producto));
        datos.append('precio', JSON.stringify(this.precio));

        this.$http.post(action,datos)
        .then(
          response => {
  
              location.reload();
   
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