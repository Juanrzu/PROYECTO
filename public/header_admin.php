<!-- Menú Lateral Derecho Fijo -->
<aside class="fixed left-0 top-0 h-screen w-64 bg-white shadow-lg z-40 border-l border-gray-200">
        <!-- Encabezado del menú -->
        <div class="p-4 border-b border-gray-200 flex items-center justify-between">
            <h5 class="text-lg font-semibold text-gray-800 uppercase">Menú</h5>
            <div class="bg-gray-100 p-1 rounded-full">
                <img class="w-8 h-8 object-contain" src="http://localhost/dashboard/Proyecto/src/escudo.png" alt="Escudo institucional">
            </div>
        </div>

        <!-- Contenido del menú -->
        <div class="flex flex-col h-[calc(100vh-120px)] justify-between p-4 overflow-y-auto">
            <ul class="space-y-2">
              <!-- Inicio -->
              <li>
                <a href="http://localhost/dashboard/Proyecto/public/display.php" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 group transition-colors">
                  <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                  </svg>
                  <span class="ml-3">Inicio</span>
                </a>
              </li>

              <!-- Examinar usuarios -->
              <li>
                <a href="http://localhost/dashboard/Proyecto/public/usuarios/usuarios.php" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 group transition-colors">
                  <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
                  </svg>
                  <span class="ml-3">Examinar usuarios</span>
                </a>
              </li>

              <!-- Actualizar preguntas -->
              <li>
                <a href="http://localhost/dashboard/Proyecto/public/usuarios/actualizar_preguntas.php" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 group transition-colors">
                  <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.3499 8.92293L19.9837 8.7192C19.9269 8.68756 19.8989 8.67169 19.8714 8.65524C19.5983 8.49165 19.3682 8.26564 19.2002 7.99523C19.1833 7.96802 19.1674 7.93949 19.1348 7.8831C19.1023 7.82677 19.0858 7.79823 19.0706 7.76998C18.92 7.48866 18.8385 7.17515 18.8336 6.85606C18.8331 6.82398 18.8332 6.79121 18.8343 6.72604L18.8415 6.30078C18.8529 5.62025 18.8587 5.27894 18.763 4.97262C18.6781 4.70053 18.536 4.44993 18.3462 4.23725C18.1317 3.99685 17.8347 3.82534 17.2402 3.48276L16.7464 3.1982C16.1536 2.85658 15.8571 2.68571 15.5423 2.62057C15.2639 2.56294 14.9765 2.56561 14.6991 2.62789C14.3859 2.69819 14.0931 2.87351 13.5079 3.22396L13.5045 3.22555L13.1507 3.43741C13.0948 3.47091 13.0665 3.48779 13.0384 3.50338C12.7601 3.6581 12.4495 3.74365 12.1312 3.75387C12.0992 3.7549 12.0665 3.7549 12.0013 3.7549C11.9365 3.7549 11.9024 3.7549 11.8704 3.75387C11.5515 3.74361 11.2402 3.65759 10.9615 3.50224C10.9334 3.48658 10.9056 3.46956 10.8496 3.4359L10.4935 3.22213C9.90422 2.86836 9.60915 2.69121 9.29427 2.62057C9.0157 2.55807 8.72737 2.55634 8.44791 2.61471C8.13236 2.68062 7.83577 2.85276 7.24258 3.19703L7.23994 3.1982L6.75228 3.48124L6.74688 3.48454C6.15904 3.82572 5.86441 3.99672 5.6517 4.23614C5.46294 4.4486 5.32185 4.69881 5.2374 4.97018C5.14194 5.27691 5.14703 5.61896 5.15853 6.3027L5.16568 6.72736C5.16676 6.79166 5.16864 6.82362 5.16817 6.85525C5.16343 7.17499 5.08086 7.48914 4.92974 7.77096C4.9148 7.79883 4.8987 7.8267 4.86654 7.88237C4.83436 7.93809 4.81877 7.96579 4.80209 7.99268C4.63336 8.26452 4.40214 8.49186 4.12733 8.65572C4.10015 8.67193 4.0715 8.68752 4.01521 8.71871L3.65365 8.91908C3.05208 9.25245 2.75137 9.41928 2.53256 9.65669C2.33898 9.86672 2.19275 10.1158 2.10349 10.3872C2.00259 10.6939 2.00267 11.0378 2.00424 11.7255L2.00551 12.2877C2.00706 12.9708 2.00919 13.3122 2.11032 13.6168C2.19979 13.8863 2.34495 14.134 2.53744 14.3427C2.75502 14.5787 3.05274 14.7445 3.64974 15.0766L4.00808 15.276C4.06907 15.3099 4.09976 15.3266 4.12917 15.3444C4.40148 15.5083 4.63089 15.735 4.79818 16.0053C4.81625 16.0345 4.8336 16.0648 4.8683 16.1255C4.90256 16.1853 4.92009 16.2152 4.93594 16.2452C5.08261 16.5229 5.16114 16.8315 5.16649 17.1455C5.16707 17.1794 5.16658 17.2137 5.16541 17.2827L5.15853 17.6902C5.14695 18.3763 5.1419 18.7197 5.23792 19.0273C5.32287 19.2994 5.46484 19.55 5.65463 19.7627C5.86915 20.0031 6.16655 20.1745 6.76107 20.5171L7.25478 20.8015C7.84763 21.1432 8.14395 21.3138 8.45869 21.379C8.73714 21.4366 9.02464 21.4344 9.30209 21.3721C9.61567 21.3017 9.90948 21.1258 10.4964 20.7743L10.8502 20.5625C10.9062 20.5289 10.9346 20.5121 10.9626 20.4965C11.2409 20.3418 11.5512 20.2558 11.8695 20.2456C11.9015 20.2446 11.9342 20.2446 11.9994 20.2446C12.0648 20.2446 12.0974 20.2446 12.1295 20.2456C12.4484 20.2559 12.7607 20.3422 13.0394 20.4975C13.0639 20.5112 13.0885 20.526 13.1316 20.5519L13.5078 20.7777C14.0971 21.1315 14.3916 21.3081 14.7065 21.3788C14.985 21.4413 15.2736 21.4438 15.5531 21.3855C15.8685 21.3196 16.1657 21.1471 16.7586 20.803L17.2536 20.5157C17.8418 20.1743 18.1367 20.0031 18.3495 19.7636C18.5383 19.5512 18.6796 19.3011 18.764 19.0297C18.8588 18.7252 18.8531 18.3858 18.8417 17.7119L18.8343 17.2724C18.8332 17.2081 18.8331 17.1761 18.8336 17.1445C18.8383 16.8247 18.9195 16.5104 19.0706 16.2286C19.0856 16.2007 19.1018 16.1726 19.1338 16.1171C19.166 16.0615 19.1827 16.0337 19.1994 16.0068C19.3681 15.7349 19.5995 15.5074 19.8744 15.3435C19.9012 15.3275 19.9289 15.3122 19.9838 15.2818L19.9857 15.2809L20.3472 15.0805C20.9488 14.7472 21.2501 14.5801 21.4689 14.3427C21.6625 14.1327 21.8085 13.8839 21.8978 13.6126C21.9981 13.3077 21.9973 12.9658 21.9958 12.2861L21.9945 11.7119C21.9929 11.0287 21.9921 10.6874 21.891 10.3828C21.8015 10.1133 21.6555 9.86561 21.463 9.65685C21.2457 9.42111 20.9475 9.25526 20.3517 8.92378L20.3499 8.92293Z" stroke="#4B5563" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8.00033 12C8.00033 14.2091 9.79119 16 12.0003 16C14.2095 16 16.0003 14.2091 16.0003 12C16.0003 9.79082 14.2095 7.99996 12.0003 7.99996C9.79119 7.99996 8.00033 9.79082 8.00033 12Z" stroke="#4B5563" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <span class="ml-3">Actualizar preguntas</span>
                </a>
              </li>

              <!-- Crear Constancia -->
              <li>
                <a href="http://localhost/dashboard/Proyecto/public/constancias.php" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 group transition-colors">
                  <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 16V10M12 10L9 12M12 10L15 12M23 15C23 12.7909 21.2091 11 19 11C18.9764 11 18.9532 11.0002 18.9297 11.0006C18.4447 7.60802 15.5267 5 12 5C9.20335 5 6.79019 6.64004 5.66895 9.01082C3.06206 9.18144 1 11.3498 1 13.9999C1 16.7613 3.23858 19.0001 6 19.0001L19 19C21.2091 19 23 17.2091 23 15Z" stroke="#4B5563" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  <span class="ml-3">Crear Constancia</span>
                </a>
              </li>

              <!-- Bitácora -->
              <li>
                <a href="http://localhost/dashboard/Proyecto/public/bitacora.php" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 group transition-colors">
                  <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600" fill="#4B5563" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 26.016q0 0.832 0.576 1.408t1.44 0.576q1.92 0.096 3.808 0.288t4.352 0.736 3.904 1.28q0.096 0.736 0.64 1.216t1.28 0.48 1.28-0.48 0.672-1.216q1.44-0.736 3.872-1.28t4.352-0.736 3.84-0.288q0.8 0 1.408-0.576t0.576-1.408v-24q0-0.832-0.576-1.408t-1.408-0.608q-0.032 0-0.096 0.032t-0.128 0q-9.504 0.256-12.672 2.528-1.024 0.768-1.12 1.44l-0.096-0.32q-0.576-1.28-3.168-2.176-3.648-1.28-10.528-1.472-0.064 0-0.128 0t-0.064-0.032q-0.832 0-1.44 0.608t-0.576 1.408v24zM4 24.128v-19.936q6.88 0.512 10.016 2.080v19.744q-3.104-1.536-10.016-1.888zM6.016 20q0.096 0 0.32 0.032t0.832 0.032 1.216 0.096 1.248 0.224 1.184 0.352 0.832 0.544 0.352 0.736v-4q0-0.096-0.032-0.224t-0.352-0.48-0.896-0.608-1.792-0.48-2.912-0.224v4zM6.016 12q0.096 0 0.32 0.032t0.832 0.032 1.216 0.096 1.248 0.224 1.184 0.352 0.832 0.544 0.352 0.736v-4q0-0.096-0.032-0.224t-0.352-0.48-0.896-0.608-1.792-0.48-2.912-0.224v4zM18.016 26.016v-19.744q3.104-1.568 9.984-2.080v19.936q-6.912 0.352-9.984 1.888zM20 22.016q0-0.576 0.608-0.992t1.504-0.576 1.76-0.288 1.504-0.128l0.64-0.032v-4q-1.696 0-2.944 0.224t-1.792 0.48-0.864 0.608-0.384 0.512l-0.032 0.192v4zM20 14.016q0-0.576 0.608-0.992t1.504-0.576 1.76-0.288 1.504-0.128l0.64-0.032v-4q-1.696 0-2.944 0.224t-1.792 0.48-0.864 0.608-0.384 0.512l-0.032 0.192v4z"/>
                  </svg>
                  <span class="ml-3">Bitácora</span>
                </a>
              </li>

              <!-- Trabajadores -->
              <li>
                <a href="http://localhost/dashboard/Proyecto/public/trabajadores/trabajadores.php" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 group transition-colors">
                  <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                    <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                  </svg>
                  <span class="ml-3">Trabajadores</span>
                </a>
              </li>

              <!-- Estudiantes Retirados -->
              <li>
                <a href="http://localhost/dashboard/Proyecto/public/estudiantes_retirados.php" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-blue-50 group transition-colors">
                  <svg class="w-5 h-5 text-gray-500 group-hover:text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                    <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                  </svg>
                  <span class="ml-3">Estudiantes Retirados</span>
                </a>
              </li>
            </ul>

            <!-- Cerrar Sesión -->
            <div class="mt-auto">
              <a href="http://localhost/dashboard/Proyecto/public/login/acciones/salir.php" class="flex items-center p-2 text-gray-700 rounded-lg hover:bg-red-50 group transition-colors">
                <svg class="w-5 h-5 text-gray-500 group-hover:text-red-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
                </svg>
                <span class="ml-3">Cerrar Sesión</span>
              </a>
            </div>
        </div>
    </aside>