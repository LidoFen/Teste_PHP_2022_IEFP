function getEstados() {

    let dados = new FormData();
    dados.append("op", 1);

    $.ajax({
        url: "controller/controllerFuncionario.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {
            $('#estadoFuncionario').html(msg);
        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });

}

function registaFuncionario() {


    let dados = new FormData();
    dados.append("op", 2);
    dados.append("bi", $('#biFuncionario').val());
    dados.append("nome", $('#nomeFuncionario').val());
    dados.append("morada", $('#moradaFuncionario').val());
    dados.append("telefone", $('#telefoneFuncionario').val());
    dados.append("email", $('#emailFuncionario').val());
    dados.append("salario", $('#salarioFuncionario').val());
    dados.append("estado", $('#estadoFuncionario').val());
    
    
    $.get('https://www.cloudflare.com/cdn-cgi/trace', function(data) {
        // Convert key-value pairs to JSON
        // https://stackoverflow.com/a/39284735/452587
    data = data.trim().split('\n').reduce(function(obj, pair) {
        pair = pair.split('=');
        return obj[pair[0]] = pair[1], obj;
    }, {});
    console.log(data);
    dados.append("ipRegisto", data.ip);
    });


    
    setTimeout(function(){ $.ajax({
        url: "controller/controllerFuncionario.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {

        let obj = JSON.parse(msg);
        if (obj.flag) {
            alerta("Sucesso", obj.msg, "success");
            getListaFuncionariosInativos();


            $("#biFuncionario").val("");
            $("#nomeFuncionario").val("");
            $("#moradaFuncionario").val("");
            $("#telefoneFuncionario").val("");
            $("#emailFuncionario").val("");
            $("#salarioFuncionario").val("");
            $("#estadoFuncionario").val("");
            
            


        } else {
            alerta("Erro", obj.msg, "error");
        }

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    }); }, 2000);


    

}

function getListaFuncionariosInativos(){

    let dados = new FormData();
    dados.append("op", 3);


    $.ajax({
        url: "controller/controllerFuncionario.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        
    })

        .done(function (msg) {
            $('#corpoTabelaFuncionarios').html(msg);

            
        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });

}

function mudarEstado(bi) {

    let dados = new FormData();
    dados.append("op", 4);
    dados.append("bi", bi);

    $.ajax({
        url: "controller/controllerFuncionario.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {

        let obj = JSON.parse(msg);
        if (obj.flag) {
            alerta("Sucesso", obj.msg, "success");
            getListaFuncionariosInativos();
            apresentaBotao(bi);

        } else {
            alerta("Erro", obj.msg, "error");
        }

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function getFuncionariosAtivos() {

    

    let dados = new FormData();
    dados.append("op", 5);

    $.ajax({
        url: "controller/controllerFuncionario.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        
    })

    .done(function (msg) {
        $('#funcionarioVindima').html(msg);

        
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });


}

function getFuncionarios() {

    let dados = new FormData();
    dados.append("op", 6);

    $.ajax({
        url: "controller/controllerFuncionario.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        
    })

    .done(function (msg) {
        $('#selectFuncionariosStock').html(msg);

        
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function apresentaBotao(bi) {

    let dados = new FormData();
    dados.append("op", 7);
    dados.append("biFuncionario", bi)

    $.ajax({
        url: "controller/controllerFuncionario.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
        
    })

    .done(function (msg) {
        $('#divBotoes').html(msg);

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}


function alerta(titulo, msg, icon) {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: icon,
        title: titulo,
        text: msg,
    })
}
$(function () {
    getFuncionarios();
    getEstados();
    getListaFuncionariosInativos();
    getFuncionariosAtivos();
    setTimeout(function() {
        $(".js-example-basic-single").select2();
      }, 100);
});