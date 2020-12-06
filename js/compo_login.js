Vue.component('peticion-asincronica',{
    props:[],
    data: function(){
        return{
            'usuario':"",
            'password':""
        }
    },
methods: {
    mostrar: function() {
        console.log(this.usuario)
        console.log(this.password)
        var action=this.$refs.form.action;
        var datos=new FormData();
        datos.append('usuario',this.usuario);
        datos.append('password', this.password);
        //console.log(action);
       // console.log(datos);
        this.$http.post(action,datos).
        then(
          response => {
  
              // ok callback
                   console.log(response);
                 
            }, response => {
            // error callback
              alert("Error en el servidor");
            }
          );
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