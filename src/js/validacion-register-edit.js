const form = document.getElementById('formulario');
   const nombre = document.getElementById('nombre');
   const apellido = document.getElementById('apellido');
   const cedula = document.getElementById('cedula');
   const telefono = document.getElementById('telefono');
   const email = document.getElementById('email');
   const usuario = document.getElementById('usuario');

   const msg = document.querySelector('.container-error');


   form.addEventListener("submit", (e)=>{

       const regexCedula = /[-._!"`'#%&,:;<>=@{}~\$\(\)\*\+\/\\\?\[\]\^\|]+/;
       const regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;         
       const regex = /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]*$/;


       var error = "";




       if (regexEmail.test(email.value)){
         email.classList.add('is-valid');
         email.classList.remove('is-invalid');
         }else{
          error += "<span class='row'>Ingrese un email valido</span>";
         email.classList.add('is-invalid');
         email.classList.remove('is-valid');
               }





               if(nombre.value == ""){
                error += "<span class='row'>El campo Nombre esta vacio</span>";
                nombre.classList.add('is-invalid');
                nombre.classList.remove('is-valid');
              }else{
                  
                if(!regex.test(nombre.value)){
                  error += "<span class='row'>Ingrese un nombre valido</span>";
                  nombre.classList.add('is-invalid');
                  nombre.classList.remove('is-valid');
                }else{
                  nombre.classList.add('is-valid');
                  nombre.classList.remove('is-invalid');
                }
              }

              if(apellido.value == ""){
                error += "<span class='row'>El campo Apellido esta vacio</span>";
                apellido.classList.add('is-invalid');
                apellido.classList.remove('is-valid');
              }else{
                if(!regex.test(apellido.value)){
                  error += "<span class='row'>Ingrese un apellido valido</span>";
                  apellido.classList.add('is-invalid');
                  apellido.classList.remove('is-valid');
                }else{
                  apellido.classList.add('is-valid');
                  apellido.classList.remove('is-invalid');
                }
              }


              
      

               
               if(usuario.value == ""){
                error += "<span class='row'>El campo Nacimiento esta vacio</span>";
                usuario.classList.add('is-invalid');
                usuario.classList.remove('is-valid');
              }else{
                usuario.classList.add('is-valid');
                usuario.classList.remove('is-invalid');
              }


              if(cedula.value == ""){
                error += "<span class='row'>Ingrese una Cedula valida</span>";
                cedula.classList.add('is-invalid');
                cedula.classList.remove('is-valid');
              }else{
                if(regexCedula.test(cedula.value)){
                  error += "<span class='row'>El campo Cedula solo admite numeros</span>";
                  cedula.classList.add('is-invalid');
                  cedula.classList.remove('is-valid');
                }else{
                 if(cedula.value.length <  7){
                   error += "<span class='row'>La cedula debe contener mas caracteres</span>";
                   cedula.classList.add('is-invalid');
                   cedula.classList.remove('is-valid');
                 }else{
                   if(cedula.value.length >  8){
                     error += "<span class='row'>La cedula debe contener menos caracteres</span>";
                     cedula.classList.add('is-invalid');
                     cedula.classList.remove('is-valid');
                   }else{
                     cedula.classList.add('is-valid');
                     cedula.classList.remove('is-invalid');
                   }
                 }
                }

              
              }

                
              if(telefono.value == ""){
                error += "<span class='row'>El campo Telefono esta vacio</span>";
                telefono.classList.add('is-invalid');
                telefono.classList.remove('is-valid');
              }else{

                if(regexCedula.test(telefono.value)){
                  error += "<span class='row'>El campo Telefono solo admite numeros</span>";
                  telefono.classList.add('is-invalid');
                  telefono.classList.remove('is-valid');
                }else{
                  if(telefono.value.length <  11){
                    error += "<span class='row'>La telefono debe contener mas caracteres</span>";
                    telefono.classList.add('is-invalid');
                    telefono.classList.remove('is-valid');
                  }else{
                    if(telefono.value.length > 11 ){
                      error += "<span class='row'>La telefono debe contener menos caracteres</span>";
                      telefono.classList.add('is-invalid');
                      telefono.classList.remove('is-valid');
                    }else{
                      telefono.classList.add('is-valid');
                      telefono.classList.remove('is-invalid');
                    }
                  }
                }
              }



              
                 
            

                                   
               if(cedula.classList.contains("is-invalid") || nombre.classList.contains("is-invalid") || apellido.classList.contains("is-invalid") || telefono.classList.contains("is-invalid") || email.classList.contains("is-invalid") || usuario.classList.contains("is-invalid")){
                  msg.innerHTML = error;
                  e.preventDefault();
                  e.stopPropagation();

               }else{
                   msg.innerHTML = "<span class='row text-success'>se ha logueado correctamente</span>";
                }


               
     });