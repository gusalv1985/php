Vue.component('peticion-asincronica',{
    props:[],
    data: function(){
        return {
            
        }
    },
    methods:{
        
    mostrar: function(event) {
        if(typeof(event.target.href)!=='undefined'){
            console.log(event.target.href);
            this.$http.get(event.target.href)
            //this.$http.get('https://jsonplaceholder.typicode.com/posts')
            .then(
                response => {
                // ok callback
                   console.log(response);
                   var auxiliar=response.data;
                    if(auxiliar.respuesta!=="error sesion"){
                        console.log("No hubo error!!!");
                        console.log(auxiliar.respuesta);
                        //console.log(this.$refs['dato']);
                        this.$refs['dato'].innerHTML=auxiliar.respuesta;
                        //return usuarios_obj;
                    }
                    else{
                    //  console.log("Hubo un error!!!");
                    }
                },
                // error callback
                response => {
                    alert("Error");					
              }
          )			
      }
    },
    borrar: function() {
        console.log("Borrando elementos");
        this.$refs['dato'].innerHTML='';
    }      
}
})

var app = new Vue({
    el:'#aplicacion',
    data: {
    },
    methods:{
  
    }
  })