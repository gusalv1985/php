Vue.component('peticion-asincronica', {
    props:[],
  data: function() {
    return {
        'usuario':"",
        'password':"",
        'passconf':"",
        'email':"",      
        'enviado': false
    }
  },
  methods: {
    mostrar: function() {
      //  console.log("Mostrando elementos");
        var error='';

        var pat_usuario=/^\w{4,12}$/i;
      	var pat_password=/^[a-z\d]{4,12}$/i;
      	var pat_email=/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      	if(!pat_usuario.test(this.usuario)){
           // console.log("Complete el usuario");		
            error+="<b>El usuario requiere entre 4 y 12 caracteres</b><BR>";
          }
          if(!pat_password.test(this.password)){
            //console.log("Complete el password");		
            error+="<b>La contraseña requiere letras y numeros entre 4 y 12 caracteres</b><BR>";
          }
            if(!pat_password.test(this.passconf)){
            console.log("Complete el passconf");		
            error+="<b>Complete la Confirmacion de contraseña</b><BR>";
          }
          if (this.password != this.passconf) {
            error+="<b>contraseña y confirmacion no coinciden</b><BR>";
            }
           if(!pat_email.test(this.email)){
            console.log("Complete el email");		
            error+="<b>Complete el email</b><BR>";
          }

          this.$refs['error'].innerHTML=error;

        if(error.length>0)
          return;
        var action=this.$refs.form.action;
        var datos=new FormData();
        datos.append('usuario',this.usuario);
        datos.append('password', this.password);
        datos.append('passconf', this.passconf);
        datos.append('email', this.email);
        console.log(action);
        console.log(datos);
        this.$http.post(action,datos)
        .then(
          response => {
  
              // ok callback
                   console.log(response);
               
                   var auxiliar=response.data;
                  if(auxiliar.mensaje=="Registro Exitoso"){
                   //console.log("No hubo error!!!");
                    //console.log(this.usuarios_obj);
                    //this.usuarios_obj=auxiliar.respuesta;
                    this.enviado=true;
                    this.$refs['mensaje'].innerHTML=auxiliar.mensaje;
            	 	}
            	 	else{
                    console.log("Hubo un error!!!");
                    console.log(JSON.stringify(auxiliar.respuesta));
                    this.$refs['mensaje'].innerHTML=JSON.stringify(auxiliar.respuesta);
            }
  
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