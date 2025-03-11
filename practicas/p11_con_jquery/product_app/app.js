
let edit = false;
$(document).ready(function () {

    

    let baseJSON = {
      precio: 0.0,
      unidades: 1,
      modelo: "XX-000",
      marca: "NA",
      detalles: "NA",
      imagen: "img/default.png"
    };
  
    function init() {
      let JsonString = JSON.stringify(baseJSON, null, 2);
      $('#description').val(JsonString);
      listarProductos();
    }
  
    function listarProductos() {
      $.get('./backend/product-list.php', function (response) {
        let productos = JSON.parse(response);
        let template = '';
  
        if (Object.keys(productos).length > 0) {
          productos.forEach(producto => {
            let descripcion = `
              <li>precio: ${producto.precio}</li>
              <li>unidades: ${producto.unidades}</li>
              <li>modelo: ${producto.modelo}</li>
              <li>marca: ${producto.marca}</li>
              <li>detalles: ${producto.detalles}</li>
            `;
  
            template += `
              <tr productId="${producto.id}">
                <td>${producto.id}</td>
                <td>
                  <a href="#" class="product-item">${producto.nombre}</a>  
                </td>
                <td><ul>${descripcion}</ul></td>
                <td>
                  <button class="product-delete btn btn-danger">Eliminar</button>
                </td>
              </tr>
            `;
          });
        }
        $('#products').html(template);
      });
    }
  
    $('#search').keyup(function () {
      let search = $(this).val();
      if (search) {
        $.get('./backend/product-search.php', { search }, function (response) {
          let productos = JSON.parse(response);
          let template = '', template_bar = '';
  
          if (Object.keys(productos).length > 0) {
            productos.forEach(producto => {
              let descripcion = `
                <li>precio: ${producto.precio}</li>
                <li>unidades: ${producto.unidades}</li>
                <li>modelo: ${producto.modelo}</li>
                <li>marca: ${producto.marca}</li>
                <li>detalles: ${producto.detalles}</li>
              `;
  
              template += `
                <tr productId="${producto.id}">
                  <td>${producto.id}</td>
                  <td>${producto.nombre}</td>
                  <td><ul>${descripcion}</ul></td>
                  <td>
                    <button class="product-delete btn btn-danger">Eliminar</button>
                  </td>
                </tr>
              `;
  
              template_bar += `<li>${producto.nombre}</li>`;
            });
  
            $('#product-result').removeClass('d-none');
            $('#container').html(template_bar);
            $('#products').html(template);
          }
        });
      }
    });
  
    $('#product-form').submit(function (e) {
        e.preventDefault();
    
        let producto = {
            id: $('#productId').val(), // Asegurar que el ID se envía
            nombre: $('#name').val().trim(),
            precio: parseFloat($('#precio').val()),
            unidades: parseInt($('#unidades').val()),
            modelo: $('#modelo').val().trim(),
            marca: $('#marca').val().trim(),
            detalles: $('#detalles').val().trim()
        };
    
        let url = edit ? 'backend/product-edit.php' : 'backend/product-add.php';
    
        $.ajax({
            url: url,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(producto),
            success: function (response) {
                try {
                    let respuesta = typeof response === "string" ? JSON.parse(response) : response;
                    alert(respuesta.message);
                    listarProductos(); // Recargar lista de productos
                } catch (error) {
                    console.error("Error al procesar JSON:", error, "Respuesta del servidor:", response);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error en AJAX:", textStatus, errorThrown);
                console.error("Respuesta del servidor:", jqXHR.responseText);
            }
        });
    });
    
    
    
      
  
    $(document).on('click', '.product-delete', function () {
      if (confirm("¿De verdad deseas eliminar el Producto?")) {
        let id = $(this).closest('tr').attr('productId');
        $.get(`./backend/product-delete.php?id=${id}`, function (response) {
          let respuesta = JSON.parse(response);
          let template_bar = `
            <li>status: ${respuesta.status}</li>
            <li>message: ${respuesta.message}</li>
          `;
  
          $('#product-result').removeClass('d-none');
          $('#container').html(template_bar);
          listarProductos();
        });
      }
    });

    $(document).on('click', '.product-item', function(){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        $.post('backend/product-single.php', {id}, function(response) {
            const producto = JSON.parse(response);
            $('#name').val(producto.nombre);
            $('#precio').val(producto.precio); 
            $('#unidades').val(producto.unidades); 
            $('#modelo').val(producto.modelo); 
            $('#marca').val(producto.marca); 
            $('#detalles').val(producto.detalles); 
            edit = true;

        })
    })
  
    init();
  });
  