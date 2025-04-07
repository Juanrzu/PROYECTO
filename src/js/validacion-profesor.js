
   const form = document.getElementById('formulario');
    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    const cedula = document.getElementById('cedula');
    const msg = document.querySelector('.container-error');


    form.addEventListener("submit", (e)=>{

        const regexCedula = /[-._!"`'#%&,:;<>=@{}~\$\(\)\*\+\/\\\?\[\]\^\|]+/;
        const regex = /^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]*$/;
        var error = "";



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

                                    
                if(cedula.classList.contains("is-invalid") || nombre.classList.contains("is-invalid") || apellido.classList.contains("is-invalid")){
                    msg.innerHTML = error;
                  e.preventDefault();
                  e.stopPropagation();
                }else{
                    msg.innerHTML = "<span class='row text-success'>se ha logueado correctamente</span>";
                }


                
      });