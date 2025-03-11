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
                <td>${producto.nombre}</td>
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
        $.post('./backend/product-search.php', { search }, function (response) {
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
      let productoJsonString = $('#description').val();
      let finalJSON = JSON.parse(productoJsonString);
      finalJSON['nombre'] = $('#name').val();
      productoJsonString = JSON.stringify(finalJSON, null, 2);
  
      $.ajax({
        url: './backend/product-add.php',
        type: 'POST',
        contentType: 'application/json',
        data: productoJsonString,
        success: function (response) {
          let respuesta = JSON.parse(response);
          let template_bar = `
            <li>status: ${respuesta.status}</li>
            <li>message: ${respuesta.message}</li>
          `;
  
          $('#product-result').removeClass('d-none');
          $('#container').html(template_bar);
          listarProductos();
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
  
    init();
  });
  