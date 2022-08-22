var App = function () {

	var calcula_frete = function () {
        $("#cal-frete").on('click', function () {
           var produto_id = $(this).attr('data-id');
           var cep = $("#cep").val();

           $.ajax({

                type : 'post',
                url: BASE_URL + 'ajax/index',
                dataType: 'json',
                data: {
                    cep: cep,
                    produto_id: produto_id,
                }
            }).then(function (response) {
               $('#retorno-frete').html(response.resposta_api_cep);
                //console.log(response);

            });
        });


	};

    return{
        init: function () {
            calcula_frete();

            }
        }

}();

jQuery(document).ready(function () {

	$(window).keydown(function (event){
		if (event.keyCode  == 13){
		
		event.preventDefault();
		return false;
		}

	});
App.init();

});
