jQuery(document).ready(function($){

    if ($("#id_distrito").length > 0) {
    selectCascada('#id_distrito','/slectparroquia','id_parroquia',0);
    }
    if ($("#id_parroquia").length > 0) {
    selectCascada('#id_parroquia','/slectcircuito','id_circuito',1);
    }
    if ($("#id_circuito").length > 0) {
    selectCascada('#id_circuito','/slectsupcircuito','id_subcircuito',2);
    }

    Eliminar();

    imprimirDiv();
    selectCascadaModulos();

    function Eliminar() {
        $(document).on('submit', '.deleteForm', function(event) {
            event.preventDefault();
            let id = $(this).attr('id_eliminar'); // Encerrar el nombre del atributo en comillas

            if (confirm('¿Estás seguro de que deseas eliminar este elemento? id->' + id)) {
                this.submit();// Utilizar jQuery para enviar el formulario
            }
        });
    }
    function selectCascada(depe,ruta,select,namedepen){

        $(document).on('change',depe,function(){



            let option= $(this).val();
   // alert(option);
             // Realizar la petición AJAX POST

             if(namedepen==0){
                  const selectElement2 = document.getElementById("id_parroquia");
                    selectElement2.innerHTML = '';
                    const selectElement3 = document.getElementById("id_circuito");
                    selectElement3.innerHTML = '';
                    const selectElement4 = document.getElementById("id_subcircuito");
                    selectElement4.innerHTML = '';

              }
              if(namedepen==1){
                const selectElement5 = document.getElementById("id_circuito");
                selectElement5.innerHTML = '';
                const selectElement6 = document.getElementById("id_subcircuito");
                selectElement6.innerHTML = '';

            }
            if(namedepen==2){
                const selectElement7 = document.getElementById("id_subcircuito");
                selectElement7.innerHTML = '';

            }
            $.ajax({
                url: ruta,
                type: "post",
                data:$('#formcontrol').serialize(),
                success: function(data) {
                    // Aquí manejas la respuesta de la consulta
                    console.log(data); // Muestra los datos recibidos en la consola
                        const selectElement = document.getElementById(select);
                        selectElement.innerHTML = '';
                        // Iterar sobre los datos del JSON para crear las opciones del select
                        data.forEach((item,index) => {
                        // Crear un elemento de opción
                        const optionElement = document.createElement('option');

                        // Asignar el valor y el texto de la opción



                        if(namedepen==0){
                        
                            optionElement.textContent = item.nombre_parroquia;
                        }
                        if(namedepen==1){
                           
                            optionElement.textContent = item.nombre_circuito;
                        }
                        if(namedepen==2){
                          
                            optionElement.textContent = item.nombre_subcircuito;
                        }

                        if (index === 0) {
                            optionElement.setAttribute('selected', 'selected');
                          }
                          optionElement.value = item.id;
                        // Agregar la opción al select
                        selectElement.appendChild(optionElement);
                        if(namedepen==1){
                        if ($("#id_circuito").length > 0) {
                            selectCascada2('#id_circuito','/slectsupcircuito','id_subcircuito',2);
                            }
                        }

                        });

                },
                error: function(xhr, status, error) {
                    console.error("Error en la petición AJAX:", error);
                }
            });

        });
    }

    function selectCascada2(depe,ruta,select,namedepen){


            let option= $(depe).val();

             // Realizar la petición AJAX POST


            $.ajax({
                url: ruta,
                type: "post",
                data:$('#formcontrol').serialize(),
                success: function(data) {
                    // Aquí manejas la respuesta de la consulta
                    console.log(data); // Muestra los datos recibidos en la consola
                        const selectElement = document.getElementById(select);
                        selectElement.innerHTML = '';
                        // Iterar sobre los datos del JSON para crear las opciones del select
                        data.forEach((item,index) => {
                        // Crear un elemento de opción
                        const optionElement = document.createElement('option');

                        // Asignar el valor y el texto de la opción


                        optionElement.value = item.id;
                        if(namedepen==0){
                            optionElement.textContent = item.nombre_parroquia;
                        }
                        if(namedepen==1){
                            optionElement.textContent = item.nombre_circuito;
                        }
                        if(namedepen==2){
                            optionElement.textContent = item.nombre_subcircuito;
                        }

                        if (index === 0) {
                            optionElement.setAttribute('selected', 'selected');
                          }
                        // Agregar la opción al select
                        selectElement.appendChild(optionElement);
                        });
                },
                error: function(xhr, status, error) {
                    console.error("Error en la petición AJAX:", error);
                }
            });

    }
    function imprimirDiv() {
        $(document).on('click', '.dereportesimprimir', function(event) {
             event.preventDefault();
             var contenidoDiv = document.getElementById("reportid").innerHTML;
             var ventanaImpresion = window.open('', '', 'width=800,height=600');
              ventanaImpresion.document.write('<html><head><title>Imprimir Div</title></head><body>');
             ventanaImpresion.document.write(contenidoDiv);
             ventanaImpresion.document.write('</body></html>');
             ventanaImpresion.document.close();
             ventanaImpresion.print();
            });
         }
         function selectCascadaModulos(){

            $(document).on('change','#nombre_modulos',function(){

                       let option= $(this).val();
                            const selectElement = document.getElementById('ruta');
                            selectElement.innerHTML = '';

                            const optionElement = document.createElement('option');


                            if('USUARIOS'==option){

                                optionElement.textContent = 'usuarios.index';
                                optionElement.value = 'usuarios.index';
                            }
                            if('DISTRITOS'==option){

                                optionElement.textContent = 'distritos.index';
                                optionElement.value = 'distritos.index';
                            }
                            if('PARROQUIAS'==option){

                                optionElement.textContent = 'parroquias.index';
                                optionElement.value = 'parroquias.index';
                            }

                            if ('CIRCUITOS' === option) {
                                optionElement.textContent = 'circuitos.index';
                                optionElement.value = 'circuitos.index';
                              }
                              if ('SUBCIRCUITOS' === option) {
                                optionElement.textContent = 'subcircuitos.index';
                                optionElement.value = 'subcircuitos.index';
                              }
                              if ('DEPENDENCIAS' === option) {
                                optionElement.textContent = 'dependencias.index';
                                optionElement.value = 'dependencias.index';
                              }
                              if ('REPORTES ATC' === option) {
                                optionElement.textContent = 'reporte_eventos.index';
                                optionElement.value = 'reporte_eventos.index';
                              }
                              if ('VEHICULOS' === option) {
                                optionElement.textContent = 'vehiculos.index';
                                optionElement.value = 'vehiculos.index';
                              }
                              if ('PERSONAL POLICIAL' === option) {
                                optionElement.textContent = 'personals.index';
                                optionElement.value = 'personals.index';
                              }
                              if ('SOLICITUD MANTENIMIENTO' === option) {
                                optionElement.textContent = 'solicitudmantenimiento.index';
                                optionElement.value = 'solicitudmantenimiento.index';
                              }
                              if ('ROLES' === option) {
                                optionElement.textContent = 'roles.index';
                                optionElement.value = 'roles.index';
                              }
                              if ('ORDEN DE MANTENIMIENTO' === option) {
                                optionElement.textContent = 'mantenimiento.index';
                                optionElement.value = 'mantenimiento.index';
                              }
                              if ('ORDEN DE MOVILIZACION' === option) {
                                optionElement.textContent = 'ordenmovilizacion.index';
                                optionElement.value = 'ordenmovilizacion.index';
                              }
                             /*  if ('REVISION === option') {
                                optionElement.textContent = 'revsion.index';
                                optionElement.value = 'revsion.index';
                              }*/

                            // Agregar la opción al select
                            selectElement.appendChild(optionElement);








            });
        }


});
