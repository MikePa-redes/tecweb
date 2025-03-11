// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    fetchProducts();
}

$(function(){

    $('#search').keyup(function() {
        if($('#search').val()) {
          let search = $('#search').val();
          $.ajax({
            url: 'product -search.php',
            data: {search},
            type: 'POST',
            success: function (response) {
              if(!response.error) {
                let product = JSON.parse(response);
                let template = '';
                product.forEach(product => {
                  template += `
                         <li><a href="#" class="product-item">${product.name}</a></li>
                        ` 
                });
                $('#product-result').show();
                $('#container').html(template);
              }
            } 
          }) 
        }
      });


      $('#product-form').submit(e => {
        e.preventDefault();
        const postData = {
          name: $('#name').val(),
          description: $('#description').val(),
          id: $('#productId').val()
        };
        const url = edit === false ? 'product-add.php' : 'product-edit.php';
        console.log(postData, url);
        $.post(url, postData, (response) => {
          console.log(response);
          $('#product-form').trigger('reset');
          fetchProducts();
        });
      });


      function fetchProducts() {
        $.ajax({
          url: 'product-list.php',
          type: 'GET',
          success: function(response) {
            const products = JSON.parse(response);
            let template = '';
            products.forEach(product => {
              template += `
                      <tr productId="${product.id}">
                      <td>${product.id}</td>
                      <td>
                      <a href="#" class="product-item">
                        ${product.name} 
                      </a>
                      </td>
                      <td>${product.description}</td>
                      <td>
                        <button class="product-delete btn btn-danger">
                         Delete 
                        </button>
                      </td>
                      </tr>
                    `
            });
            $('#products').html(template);
          }
        });
      }


      $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('product-single.php', {id}, (response) => {
          const product = JSON.parse(response);
          $('#name').val(product.name);
          $('#description').val(product.description);
          $('#productId').val(product.id);
          edit = true;
        });
        e.preventDefault();
      });

      $(document).on('click', '.product-delete', (e) => {
        if(confirm('Desea eliminar este producto?')) {
          const element = $(this)[0].activeElement.parentElement.parentElement;
          const id = $(element).attr('productId');
          $.post('product-delete.php', {id}, (response) => {
            fetchProducts();
          });
        }
      });
    });
