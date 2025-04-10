<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Estilos para el modal (puedes ajustarlos según tus necesidades) */
        .hidden { display: none; }
        .fixed { position: fixed; }
        .overflow-y-auto { overflow-y: auto; }
        .rounded-lg { border-radius: 0.5rem; }
        .bg-white { background-color: white; }
        .shadow { box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .modal {
            max-width: 400px; /* Cambia el ancho máximo según lo necesites */
            width: 100%; /* Cambia el ancho para que sea un porcentaje de la pantalla */
            height: auto; /* Adelante con altura automática */
            padding: 20px; /* Ajusta el padding si deseas menos espacio */
        }
    </style>
</head>
<body>
    <div>
        <td class="bg-red-500 dark:bg-red-800 hover:bg-red-400"> 
            <form method="POST" action="#">
                <div id="modal-retirar" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto fixed top-0 right-0 left-0 bottom-0 justify-center items-center w-full z-50">
                    <div class="modal">
                        <div class="relative bg-white rounded-lg shadow mt-28">
                            <div class="flex items-center justify-between p-4 border-b rounded-t">
                                <h3 class="text-xl font-semibold text-gray-900">Aviso de Inactividad</h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 rounded-lg text-sm inline-flex justify-center items-center" id="closeModalBtn">
                                    X
                                </button>
                            </div>
                            <div class="p-4 md:p-5 space-y-4">
                                <p class="text-base leading-relaxed text-gray-500">La sesión cerrará en los próximos 30 segundos si continúa la inactividad.</p>
                            </div>
                            <div class="flex items-center p-4 border-t border-gray-200 rounded-b">
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5" id="closeModalBtn2">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </td>
    </div>

    <script>
        function cuenta_regresiva() {
            let n = 60;
            let contador = setInterval(cuenta, 1000);
            function cuenta() {
                // Resetea el contador cuando el mouse se mueve
                document.onmousemove = function () {
                    n = 60;
                };

                n--;

                if (n <= 30) {
                    // Mostrar el modal a los 30 segundos
                    document.getElementById("modal-retirar").classList.remove("hidden");
                }

                if (n <= 0) { // Cuando el tiempo llega a 0
                    alert("La sesión expiró");
                    clearInterval(contador); // Detener el contador
                    location.href = "http://localhost/dashboard/Proyecto/public/login/acciones/salir.php";
                }
            }
        }

        // Cerrar el modal
        function closeModal() {
            document.getElementById("modal-retirar").classList.add("hidden");
        }

        // Event listeners para cerrar el modal
        document.getElementById("closeModalBtn").addEventListener("click", closeModal);
        document.getElementById("closeModalBtn2").addEventListener("click", closeModal);

        cuenta_regresiva();
    </script>
</body>
</html>
