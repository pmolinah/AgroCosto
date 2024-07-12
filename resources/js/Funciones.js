//verificacion rut empresa
$(document).ready(function(){
    $('#rut').blur(function(){
        /* validación de rut */
    var rut=$('#rut').val();
    if (rut.toString().trim() != '' && rut.toString().indexOf('-') > 0) {
        var caracteres = new Array();
        var serie = new Array(2, 3, 4, 5, 6, 7);
        var dig = rut.toString().substr(rut.toString().length - 1, 1);
        rut = rut.toString().substr(0, rut.toString().length - 2);

        for (var i = 0; i < rut.length; i++) {
            caracteres[i] = parseInt(rut.charAt((rut.length - (i + 1))));
        }

        var sumatoria = 0;
        var k = 0;
        var resto = 0;

        for (var j = 0; j < caracteres.length; j++) {
            if (k == 6) {
                k = 0;
            }
            sumatoria += parseInt(caracteres[j]) * parseInt(serie[k]);
            k++;
        }

        resto = sumatoria % 11;
        var dv;
        dv = 11 - resto;

        if (dv == 10) {
            dv = "K";
        }
        else if (dv == 11) {
            dv = 0;
        }

        if (dv.toString().trim().toUpperCase() == dig.toString().trim().toUpperCase()){
            
            $.get('/api/datos/'+rut+'-'+dv+'/Empresa/',function(res){
              
                if(res==1){
                    Swal.fire({
                        icon: 'error',
                        type: 'error',
                        title: 'Oops...',
                        text: 'Empresa ya Existe!',
                        footer: '<a href>Verificque Rut</a>'
                    })
                    document.getElementById('rut').value='';
                }
            });
        }else{
        //inicio
        Swal.fire({
            icon: 'error',
            type: 'error',
            title: 'Oops...',
            text: 'Rut Incorrecto!',
            footer: '<a href>Verificque Rut</a>'
        })
        //fin
        }
    }else{
        Swal.fire({
            icon: 'error',
        
            title: 'Error...',
            text: 'El Rut está vacio o no existe!!',
        })
    }
/* fin */
    });
});
//funciones de cambio de seleccion
    $(function(){
        $('#empresa_id').on('change', Cambio_empresa);
        $('#empresa_idDos').on('change', Cambio_empresaDos);
        $('#campo_id').on('change', Cambio_campo);
        $('#empresaPlan_id').on('change', Cambio_empresa_plan);
        $('#campoPlan_id').on('change', Cambio_campo_plan);
        $('#envase_id').on('change',Cambio_envase_plan);
  
    });

   
    function Cambio_envase_plan(){
        var caID = $('#campoPlan_id').val();
        var enID = $('#envase_id').val();

        $.get('/api/stock/'+caID+'/envase/'+enID+'/empresa',function(info){
            $('#stock').val(info[0].stock);
        });

    }
    
    function Cambio_empresa_plan(){
        var id = $(this).val();
        
        $.get('/api/Seleccion/'+id+'/EmpresaPlan', function(info){
                var html_select ='<option value=""></option>';
                for (var i=0; i<info.length; ++i){
                    html_select +='<option value="'+info[i].id+'">'+info[i].campo+'</option>';
                    $('#campoPlan_id').html(html_select);
                }    
        });
    }

    function Cambio_campo_plan(){
        var id = $(this).val();
        
        $.get('/api/Seleccion/'+id+'/CampoPlan', function(info){
                var html_select ='<option value=""></option>';
                for (var i=0; i<info.length; ++i){
                    html_select +='<option value="'+info[i].id+'">'+info[i].observaciones+'</option>';
                    $('#cuartelPlan_id').html(html_select);
                }    
            });
    }


    function Cambio_empresa(){
    var id = $(this).val();
    
    $.get('/api/Seleccion/'+id+'/Empresa', function(info){
            var html_select ='<option value=""></option>';
            for (var i=0; i<info.length; ++i){
                html_select +='<option value="'+info[i].id+'">'+info[i].campo+'</option>';
                $('#campo_id').html(html_select);
            }    
        });
    }
    function Cambio_empresaDos(){
        var id = $(this).val();
        
        $.get('/api/Seleccion/'+id+'/Empresa', function(info){
                var html_select ='<option value=""></option>';
                for (var i=0; i<info.length; ++i){
                    html_select +='<option value="'+info[i].id+'">'+info[i].campo+'</option>';
                    $('#campo_idDos').html(html_select);
                }    
            });
        }
    function Cambio_campo(){
        var id = $(this).val();
        
        $.get('/api/Seleccion/'+id+'/Campo', function(info){
                var html_select ='<option value=""></option>';
                for (var i=0; i<info.length; ++i){
                    html_select +='<option value="'+info[i].id+'">'+info[i].observaciones+'</option>';
                    $('#cuartel_id').html(html_select);
                }    
            });
    }

    $(document).ready(function(){
        $('#cuartel_id').change(function(){
            var cuartel_id = $('#cuartel_id').val();
            $.get('/api/Seleccion/'+cuartel_id+'/Cuartel', function(info){
                $('#superficiecuartel').val(info[0].superficie);
            });
        });

        $('#cuartelPlan_id').change(function(){
            var cuartelPlan_id = $('#cuartelPlan_id').val();
        
            $.get('/api/Seleccion/'+cuartelPlan_id+'/CuartelPlan', function(info){
                
                $('#especie_id').val(info[1]);
                $('#CantidadMaxima').val(info[2]);
                $('#CantidadPlantada').val(info[3]);
                $('#Capataz').val(info[4]);
                $('#Administrador').val(info[5]);
                $('#variedad').val(info[6]);
                $('#plantacion_id').val(info[7]);
                $('#superficie').val(info[8]);
       
            });
        });

        $('#especie_id').change(function(){
            var especie_id = $('#especie_id').val();
            $.get('/api/Seleccion/'+especie_id+'/Especie', function(info){
                
                var cantidad;
                var superficieCuartel = $('#superficiecuartel').val()
                var distanciaPlanta = info[0].distanciaPlanta;
                var metros2 = info[0].metros2;
                
                cantidad = (parseInt(metros2) * parseInt(distanciaPlanta));
                superficieCuartel=superficieCuartel*10000;
                cantidad = (superficieCuartel/cantidad);
                
                $('#cantidadPlantas').val(cantidad.toFixed(2));
                $('#cantidadPlantasDisabled').val(cantidad.toFixed(2));
                
            });
        });

        $('#cantidadPlantada').change(function(){
            var cantidadPlantada = parseInt($('#cantidadPlantada').val());
            var cantidadPlantas = parseInt($('#cantidadPlantas').val());
                    if (cantidadPlantada > cantidadPlantas){
                
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Cantidad de Plantas sobrepasa limite!',
                    footer: '<a href="">Revisar Capacidad del Cuartel...</a>'
                  })
            }

           
        });


       
    });

    $(document).ready(function(){
        
        $("#btnGbr").prop("disabled", true);
        $('#Agregar').click(function(){
            var selectedOption = $('#exportadora_id option:selected');
            var valores = [];
            var KilosMatriz = [];
            var totalkilos = 0;
            var selectedValue = selectedOption.val();
            selectedValue=selectedValue.trim();
            var exID = selectedValue
            var enID = $('#envase_id').val();
            $.get('/api/stock/'+exID+'/envase/'+enID+'/exportadora', function(info){
           
                var stockEnv = info[0];
                var capacidad = info[1];
                var kilos = $('#nuevoskilos').val();
                var capacidadTotal=parseInt(stockEnv)*parseInt(capacidad);
                var resul = parseInt(capacidadTotal)/parseFloat(kilos);
                if(isNaN(resul)){
                    Swal.fire({
                        icon: 'error',
                    
                        title: 'Error...',
                        text: 'No puede Continuar, Exportadora no Tiene Cuenta Corriente en ese Tipo de Envase!!',
                    })
                }
                if(resul<1){
                    alert('La cantidad de Envases en cuenta corriente podria no cubrir la necesidad de la exportador, favor revisar stock de envases');
                    //alert(resul);
                }
                if(kilos>0)
                {

                    $('input[name="kilosexportadora[]"]').each(function() {
                        KilosMatriz.push($(this).val());
                    });
                    
                    //alert(KilosMatriz.length);

                    for(i=0; i<KilosMatriz.length;i++){
                        totalkilos=parseFloat(totalkilos)+parseFloat(KilosMatriz[i]);
                    }
                    totalkilos=parseFloat(totalkilos)+ parseFloat(kilos);
                    $('#totadekilos').val(totalkilos);

                
                    $('input[name="exportadora_id[]"]').each(function() {
                        KilosMatriz.push($(this).val());
                    });
                    
                    var selectedValue = selectedOption.val();
                    var selectedText = selectedOption.text();
                    selectedText=selectedText.trim();
                    selectedValue=selectedValue.trim();

                            var detenerCiclo =false;
                            for (var i = 0; i < valores.length; i++) {
                                if (selectedValue == valores[i]) {
                                    valores = []; // Vacía el array 'valores'
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error...',
                                        text: 'Exportadora ya existe',
                                        footer: '<a href="">Verifique dato</a>'
                                    })
                                    
                                    detenerCiclo = true;
                                    break; // Detiene el ciclo
                                }
                            }
                            if (detenerCiclo) {
                            }else{
                                $("#grilla tbody").append('<tr class="border-2" id="fila'+selectedValue+'"><td class="border-2"><input type="hidden" value="'+selectedValue+'" id="matrizdatos" name="exportadora_id[]"><label class="bg-transparent text-neutral-900 w-full">'+selectedText+'</label></td><td class="border-2"><input value="'+kilos+'" name="kilosexportadora[]" id="valoreskilos" class="bg-transparent text-center text-neutral-900"></td><td class="border-2"><label class="text-neutral-900">'+stockEnv+'</label></td><td class="border-2"><center><button type="button" onclick="EliminarSolicitudCliente('+selectedValue+')" class="inline-block rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i class="far fa-trash-alt"></i></button></center></td></tr>')

                            }
                    

                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Cantidad de Kilos vacio',
                        footer: '<a href="">Verifique dato</a>'
                    })
                };
            });
        });

        $('#AgregarContratista').click(function(){
            $("#btnGbr").prop("disabled", false);
            var contratista_id = $('#contratista_id option:selected');
            var cont_id = contratista_id.val();
            var cont_nm = contratista_id.text();
            var valorescontratista = [];
            var tratoxcosecha = $('#tratoxcosecha').val();
            var detenerCiclo =false;
            $('.input-contratista').each(function() {
                valorescontratista.push($(this).val());
            });
            for (var i = 0; i < valorescontratista.length; i++) {
                if (cont_id == valorescontratista[i]) {
                    valorescontratista = []; // Vacía el array 'valores'
                    Swal.fire({
                        icon: 'error',
                        title: 'Error...',
                        text: 'Contratista ya Existe...',
                        footer: '<a href="">Verifique dato</a>'
                    })
                    
                    detenerCiclo = true;
                    break; // Detiene el ciclo
                }
            }
            if (detenerCiclo) {
            }else{
                $("#grilla2 tbody").append(`<tr id="filas${cont_id}"><td class="justify-center p-1 hidden sm:hidden md:block xl:block"><input value="${cont_id}" id="matrizdatoscontratista" name="id[]" class="input-contratista bg-transparent text-center text-neutral-900"></td><td><label class="bg-transparent text-neutral-900 w-full">${cont_nm}</label></td><td><input class="text-neutral-900" type="num" name="tratoxcosecha[]" value="${tratoxcosecha}"></td><td><center><button type="button" onclick="EliminarContratista(${cont_id})" class="inline-block rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i class="far fa-trash-alt"></i></button></center></td></tr>`)
                
            };
            
        });
                          
    });
    $(document).ready(function(){
        $('#agregarKilos').click(function(){
            var expoID = $('#expoID').val();
            var nuevoElementoID = 'kilosExpo' + expoID;
            alert(nuevoElementoID);
            var valorExpo = $('#'+nuevoElementoID).val();
            alert(valorExpo);
        })

    });
    
    //suma de envases de exportadora
    $(document).ready(function(){
        $('#btnsumarenvase').click(function(){
            var cantidadColor = $('#cantidadColor').val();
            var color_id = $('#color_id').val();
            var verdad = true;
            var saldoInicial = $('#saldoInicial').val();
            $('#cantidadColor').val(0);
            
            
            $.get('/api/recuperar/'+color_id+'/color',function(dato){
                var listacolores = [];
                $('input[name="colores_id[]"]').each(function() {
                    listacolores.push($(this).val());
                });
                
                if (listacolores.length>0){
                    for(var i=0; i<listacolores.length;i++){
                        if (dato==listacolores[i]){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error...',
                                text: 'Color de Envase ya agregado...',
                                footer: '<a href="">Verifique dato</a>'
                            })
                            Break;
                        }
                    }
                }
                var suma = parseInt(saldoInicial)+parseInt(cantidadColor);
                document.getElementById('saldoInicial').value=suma;
                           
                if(verdad){
                    $("#grillaColor tbody").append('<tr id="filaColor'+color_id+'"><td class="justify-center p-1 hidden sm:hidden md:block xl:block"><input value="'+cantidadColor+'" name="CantidadEnvaseColor[]" wire:model.defer="CantidadEnvaseColor" class="input-element bg-transparent text-center text-neutral-900"></td><td><input value="'+dato+'" id="colores_id"  name="colores_nom[]" class="bg-transparent text-center text-neutral-900"></td><td><center><button type="button" onclick="EliminarColorEnvase('+color_id+','+cantidadColor+')" class="inline-block rounded bg-danger px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i class="far fa-trash-alt"></i></button></center></td></tr>')   
                };
            });
        });
    });

//boton de eliminar exportadora
        
$('#btnEliminar').click(function(){
    var boton = document.getElementById('btnEliminar'); // Obtén una referencia al botón por su ID o como desees.
    var valorPersonalizado = boton.getAttribute('data-valor');
    Swal.fire({
        title: 'Desea Elimar la Cuenta?',
        text: "Ya no se podrá recuperar el Stock Inicial!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.get('/api/Eliminar/Cuenta/'+valorPersonalizado+'/Envases',function(result){

            });
            
            Swal.fire(
                'Elimanada!',
                'La Cuenta Corriente de Envase de la Exportadora fue eliminada.',
                'success'
            )
            setTimeout(function() {
                location.reload();
                }, 3000);
            
            
        }
        })
});

// suma de envases de campo
$(document).ready(function(){
    $('#btnsumarenvaseDos').click(function(){
        
        var cantidadColorDos = $('#cantidadColorDos').val();
        var color_idDos = $('#color_idDos').val();
        var verdadDos = true;
        var saldoInicialDos = $('#saldoInicialDos').val();
        $('#cantidadColorDos').val(0);
        
        
        $.get('/api/recuperar/'+color_idDos+'/color',function(dato){
            var listacolores = [];
            $('input[name="colores_idDos[]"]').each(function() {
                listacolores.push($(this).val());
            });
            
            if (listacolores.length>0){
                for(var i=0; i<listacolores.length;i++){
                    if (dato==listacolores[i]){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error...',
                            text: 'Color de Envase ya agregado...',
                            footer: '<a href="">Verifique dato</a>'
                        })
                        Break;
                    }
                }
            }
            var suma = parseInt(saldoInicialDos)+parseInt(cantidadColorDos);
            document.getElementById('saldoInicialDos').value=suma;
                       
            if(verdadDos){
            $("#grillaColorDos tbody").append('<tr id="filaColorDos'+color_idDos+'"><td class="border-2 justify-center p-2 hidden sm:hidden md:block xl:block"><input value="'+cantidadColorDos+'" name="CantidadEnvaseColorDos[]"  class="input-element bg-transparent text-center text-neutral-900"></td><td class="border-2"><input value="'+dato+'" id="colores_idDos"  name="colores_nomDos[]" class="bg-transparent text-center text-neutral-900"></td><td class="border-2"><center><button type="button" onclick="EliminarColorEnvaseDos('+color_idDos+','+cantidadColorDos+')" class="inline-block rounded bg-red-800 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-900 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]"><i class="far fa-trash-alt"></i></button></center></td></tr>')   
            };
        });
    });
});

//boton eliminar campo
$('#btnEliminarCampo').click(function(){
    var boton = document.getElementById('btnEliminarCampo'); // Obtén una referencia al botón por su ID o como desees.
    var valorPersonalizado = boton.getAttribute('data-valor');
    Swal.fire({
        title: 'Desea Elimar la Cuenta?',
        text: "Ya no se podrá recuperar el Stock Inicial!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminar!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.get('/api/Eliminar/Cuenta/'+valorPersonalizado+'/Envases/Campo',function(result){

            });
            
            Swal.fire(
                'Elimanada!',
                'La Cuenta Corriente de Envase de la Exportadora fue eliminada.',
                'success'
            )
            setTimeout(function() {
                location.reload();
                }, 3000);
            
            
        }
        })
});
$("#btnGbr").click(function(){
    $("#totadekilos").prop("disabled", false);
});




// fin


      
// JavaScript to toggle the dropdown
// const dropdownButton = document.getElementById('dropdown-button');
// const dropdownMenu = document.getElementById('dropdown-menu');
// const searchInput = document.getElementById('search-input');
// let isOpen = false; // Set to true to open the dropdown by default

// Function to toggle the dropdown state
// function toggleDropdown() {
//   isOpen = !isOpen;
//   dropdownMenu.classList.toggle('hidden', !isOpen);
// }

// // Set initial state
// // toggleDropdown();

// dropdownButton.addEventListener('click', () => {
//   toggleDropdown();
// });

// // Add event listener to filter items based on input
// searchInput.addEventListener('input', () => {
//   const searchTerm = searchInput.value.toLowerCase();
//   const items = dropdownMenu.querySelectorAll('a');

//   items.forEach((item) => {
//     const text = item.textContent.toLowerCase();
//     if (text.includes(searchTerm)) {
//       item.style.display = 'block';
//     } else {
//       item.style.display = 'none';
//     }
//   });
// });


