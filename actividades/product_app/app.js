 // JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

$(document).ready(function(){
    let edit = false;

    let JsonString = JSON.stringify(baseJSON,null,2);
    $('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    productos.forEach(producto => {
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                                let descripcion = '';
                                descripcion += '<li>precio: '+producto.precio+'</li>';
                                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                                descripcion += '<li>marca: '+producto.marca+'</li>';
                                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            
                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();
    
        if (errorActivo) {
            actualizarBarraEstado("Error", "Corrige los errores antes de enviar el formulario.");
            return;
        }
    
        // Recoger los valores del formulario
        let postData = {
            nombre: $('#nombre').val().trim(),
            marca: $('#marca').val().trim(),
            modelo: $('#modelo').val().trim(),
            precio: parseFloat($('#precio').val()),
            detalles: $('#detalles').val().trim(),
            unidades: parseInt($('#unidades').val()),
            imagen: $('#imagen').val().trim() || "https://via.placeholder.com/150",  // Imagen por defecto si está vacía
            id: $('#productId').val() // Si necesitas manejar edición
        };
    
        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
    
        $.post(url, postData, (response) => {
            let respuesta = JSON.parse(response);
    
            let template_bar = `
                <li style="list-style: none;">status: ${respuesta.status}</li>
                <li style="list-style: none;">message: ${respuesta.message}</li>
            `;
    
            $('#product-result').show();
            $('#container').html(template_bar);
    
            if (respuesta.status === "success") {
                // Reiniciar formulario solo si se agregó correctamente
                $('#product-form')[0].reset();
                $('button.btn-primary').text("Agregar Producto");
                edit = false;
            }
    
            listarProductos();
        });
    });
    
    

        $(document).on('click', '.product-delete', (e) => {
            if(confirm('¿Realmente deseas eliminar el producto?')) {
                const element = $(this)[0].activeElement.parentElement.parentElement;
                const id = $(element).attr('productId');
                $.post('./backend/product-delete.php', {id}, (response) => {
                    $('#product-result').hide();
                    listarProductos();
                });
        }
    });

    $(document).on('click', 'tr[productid]', function(e) {
        e.preventDefault();
    
        const id = $(this).attr('productid'); // Obtiene correctamente el ID
        console.log("ID del producto seleccionado:", id);
    
        if (!id) {
            console.error("Error: No se obtuvo un ID válido.");
            return;
        }
    
        $.post('./backend/product-single.php', { id }, (response) => {
            let product = JSON.parse(response);
    
            if (!product || Object.keys(product).length === 0) {
                console.error("Error: Producto no encontrado.");
                return;
            }
    
            console.log("Producto obtenido:", product);
    
            // Llenar los campos con la información del producto
            $('#nombre').val(product.nombre);
            $('#marca').val(product.marca);
            $('#modelo').val(product.modelo);
            $('#precio').val(product.precio);
            $('#detalles').val(product.detalles);
            $('#unidades').val(product.unidades);
            $('#productId').val(product.id); // Asegura que el ID se guarde en el input oculto
    
            // NO puedes asignar valor a un input type="file", así que se deja vacío
            $('#imagen').val('');
    
            // Activar modo edición
            edit = true;
            $('button.btn-primary').text("Modificar Producto");
        });
    });
    
    $('#nombre').on('input', function() {
        let nombreProducto = $(this).val().trim();
        
        if (nombreProducto.length > 0) {
            $.post('./backend/validar-nombre.php', { nombre: nombreProducto }, function(response) {
                let resultado = JSON.parse(response);

                if (resultado.status === 'exists') {
                    actualizarBarraEstado("Error", "El nombre ya existe.");
                }
            });
        } else {
            $('#status-bar').text('');
        }
    });
    
    let errorActivo = false; // Variable compartida para controlar errores
    function verificarErrores() {
        // Si no hay errores en ningún campo, desactiva la bandera
        if ($("#product-form").find(".error").length === 0) {
            errorActivo = false;
            $("#product-result").hide(); // Oculta la barra de estado si no hay errores
        }
    }

    function actualizarBarraEstado(status, message) {
        let template_bar = `
            <li style="list-style: none;">status: ${status}</li>
            <li style="list-style: none;">message: ${message}</li>
        `;
        $("#product-result").show(); // Se muestra la barra de estado
        $("#container").html(template_bar); // Se inserta el mensaje
    }

    $("#nombre").blur(function() {
        let valor = $(this).val().trim();
        if (valor === "" || valor.length > 100) {
            actualizarBarraEstado("Error", "El nombre es requerido y debe tener 100 caracteres o menos.");
            errorActivo = true;
            $(this).addClass("error");
        } else {
            $(this).removeClass("error");
            verificarErrores();
        }
    });

    $("#marca").blur(function() {
        if ($(this).val() === "") {
            actualizarBarraEstado("Error", "Debe seleccionar una marca.");
            errorActivo = true;
            $(this).addClass("error");
        } else {
            $(this).removeClass("error");
            verificarErrores();
        }
    });

    $("#modelo").blur(function() {
        let valor = $(this).val().trim();
        if (valor === "" || valor.length > 25 || !/^[a-zA-Z0-9]+$/.test(valor)) {
            actualizarBarraEstado("Error", "El modelo es requerido, alfanumérico y de 25 caracteres o menos.");
            errorActivo = true;
            $(this).addClass("error");
        } else {
            $(this).removeClass("error");
            verificarErrores();
        }
    });

    $("#precio").blur(function() {
        let precio = parseFloat($(this).val());
        if (isNaN(precio) || precio <= 99.99) {
            actualizarBarraEstado("Error", "El precio es requerido y debe ser mayor a 99.99.");
            errorActivo = true;
            $(this).addClass("error");
        } else {
            $(this).removeClass("error");
            verificarErrores();
        }
    });

    $("#detalles").blur(function() {
        let valor = $(this).val().trim();
        if (valor.length > 250) {
            actualizarBarraEstado("Error", "Los detalles deben tener 250 caracteres o menos.");
            errorActivo = true;
            $(this).addClass("error");
        } else {
            $(this).removeClass("error");
            verificarErrores();
        }
    });

    $("#unidades").blur(function() {
        let unidades = parseInt($(this).val());
        if (isNaN(unidades) || unidades < 0) {
            actualizarBarraEstado("Error", "Las unidades son requeridas y deben ser mayor o igual a 0.");
            errorActivo = true;
            $(this).addClass("error");
        } else {
            $(this).removeClass("error");
            verificarErrores();
        }
    });

    $("#imagen").blur(function() {
        if ($(this).val().trim() === "") {
            $(this).val("https://via.placeholder.com/150");
        }
    });
    
});