function getAnos(idVinha) {

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("idVinha", idVinha);

    $.ajax({
        url: "controller/controllerVinha.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {

            let obj = JSON.parse(msg);

            
            if(obj.msg) {
                $('#novoAnoVindimaDiv').hide();
                $('#anoVindima').html(obj.msg);

                const options = $('#anoVindima option');
                
                if (options.length === 1) {
                    $("#anoVindimaDiv").hide();
                    $('#novoAnoVindimaDiv').show();
                    $('#novoAnoVindimaDiv').html(
                        '<label for="novoAnoVindima" class="form-label">Ano</label><input type="number" placeholder="" class="form-control" id="novoAnoVindima" name="novoAnoVindima"><p class="mt-3" style="font-style: italic; weight: 100;">(Devido á necessidade que o ano da vindima seja igual ao superior ao da vinha, introduza um ano válido)</p>'
                        
                    );
                } else {
                    $("#anoVindimaDiv").show();

                }
            }

            
        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });

}

function getCastas() {

    let dados = new FormData();
    dados.append("op", 2);

    $.ajax({
        url: "controller/controllerVinha.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {
            
            let obj = JSON.parse(msg);
            if(obj.msg) {
                $('#listaCheckboxes').html(obj.msg);
            }

            if(obj.msg1) {
                $('#listaCheckboxesEdit').html(obj.msg1);
            }

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
}

function registaVinha() {

    let dados = new FormData();
    dados.append("op", 3);
    dados.append("descricaoVinha", $('#descricaoVinha').val());
    dados.append("hectaresVinha", $('#hectaresVinha').val());
    dados.append("dataPlantacaoVinha", $('#dataPlantacaoVinha').val());
    dados.append("anoPrimeiraColheitaVinha", $('#anoPrimeiraColheitaVinha').val());
    dados.append("fotoVinha", $('#fotoVinha').prop('files')[0]);

    let temp = [];

    for (let i = 0; i < 5; i++) {
        if ($("#casta" + (i + 1)).is(":checked")) {
            temp.push($("#casta" + (i + 1)).val());
        }
    }

    

    
    dados.append("castas", JSON.stringify(temp));


    $.ajax({
        url: "controller/controllerVinha.php",
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
            
            getListaVinhas();


            $("#idVinha").val("");
            $("#descricaoVinha").val("");
            $("#hectaresVinha").val("");
            $("#dataPlantacaoVinha").val("");
            $("#anoPrimeiraColheitaVinha").val("");
            $("#fotoVinha").val("");
            $("#listaCheckboxes input[type='checkbox']").prop('checked', false);
            $("#listaCheckboxesEdit input[type='checkbox']").prop('checked', false);
            
            


        } else {
            alerta("Erro", obj.msg, "error");
        }

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });

}

function getListaVinhas(){

    let dados = new FormData();
    dados.append("op", 4);


    $.ajax({
        url: "controller/controllerVinha.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {
            $('#corpoTabelaVinhas').html(msg)
            
        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });

}

function removerVinha(id) {

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("id", id);

    $.ajax({
        url: "controller/controllerVinha.php",
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
                getListaVinhas();
            } else {
                alerta("Erro", obj.msg, "error");
            }

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
}

function getDadosVinha(id) {

    let dados = new FormData();
    dados.append("op", 6);
    dados.append("id", id);

    $.ajax({
        url: "controller/controllerVinha.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {
            let obj = JSON.parse(msg);
            $('#idVinhaEdit').val(obj.dadosVinha.id);
            $('#descricaoVinhaEdit').val(obj.dadosVinha.descricao);
            $('#hectaresVinhaEdit').val(obj.dadosVinha.ha);
            $('#dataPlantacaoVinhaEdit').val(obj.dadosVinha.data_plantacao);
            $('#anoPrimeiraColheitaVinhaEdit').val(obj.dadosVinha.ano_p_colheita);
            $('#fotoVinhaAtualEdit').attr('src', obj.dadosVinha.foto);

            $('#modalVinha').modal('show');

            $('#btnGuardar').attr("onclick", "guardaEdit(" + obj.dadosVinha.id + ")")
        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
}

function guardaEdit(id) {

    let dados = new FormData();
    dados.append("op", 7);
    dados.append("id", id);
    dados.append("descricao", $('#descricaoVinhaEdit').val());
    dados.append("hectares", $('#hectaresVinhaEdit').val());
    dados.append("dataPlantacao", $('#dataPlantacaoVinhaEdit').val());
    dados.append("anoPrimeiraColheita", $('#anoPrimeiraColheitaVinhaEdit').val());
    dados.append("fotoVinha", $('#fotoVinhaEdit').prop('files')[0]);

    let temp = [];

    for (let i = 0; i < 5; i++) {
        if ($("#castaEdit" + (i + 1)).is(":checked")) {
            temp.push($("#castaEdit" + (i + 1)).val());
        }
    }

    

    
    dados.append("castas", JSON.stringify(temp));
    

    $.ajax({
        url: "controller/controllerVinha.php",
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
                $('#modalVinha').modal('hide');
                getListaVinhas();

                $("#listaCheckboxesEdit input[type='checkbox']").prop('checked', false);

            } else {
                alerta("Erro", obj.msg, "error");
            }

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
}

function getDadosCastas(id) {
    
    let dados = new FormData();
    dados.append("op", 8);
    dados.append("id", id);

    

    $.ajax({
        url: "controller/controllerVinha.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {


        $('#corpoTabelaCastas').html(msg);

        $('#modalCastas').modal('show');

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });


}

function getVinhasSelect() {

    let dados = new FormData();
    dados.append("op", 9);

    $.ajax({
        url: "controller/controllerVinha.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {

        

        $('#vinhaVindima').html(msg);

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function registaVindima() {

    let dados = new FormData();
    dados.append("op", 10);
    dados.append("idVinha", $("#vinhaVindima").val());
    dados.append("idFuncionario", $("#funcionarioVindima").val());
    dados.append("kg", $("#kgVindima").val());
    dados.append("dataHora", $("#dataHoraVindima").val());
    dados.append("anoVindima", $("#anoVindima").val());
    var novoAnoVindimaValue = parseInt($("#novoAnoVindima").val(), 10);

    if (!isNaN(novoAnoVindimaValue)) {
        dados.append("novoAnoVindima", novoAnoVindimaValue);
        
    }



    

    $.ajax({
        url: "controller/controllerVinha.php",
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
            getListaVindimas();
            getStock();
            getAnos1();
            

            $("#vinhaVindima").val("-1");
            $("#funcionarioVindima").val("-1");
            $("#kgVindima").val("");
            $("#dataHoraVindima").val("");
            $("#anoVindima").val("");
            $("#novoAnoVindima").val("");

        } else {
            alerta("Erro", obj.msg, "error");
        }

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });



}

function getListaVindimas(){


    let dados = new FormData();
    dados.append("op", 11);


    $.ajax({
        url: "controller/controllerVinha.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {
            
            $('#corpoTabelaVindimas').html(msg);
            
        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });

}

function getStock() {

    let dados = new FormData();
    dados.append("op", 12);

    $.ajax({
        url: "controller/controllerVinha.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

        .done(function (msg) {
            $('#corpoTabelaStock').html(msg);

        })

        .fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
}

function incrementarValor(idVinho) {
    var value = $("#quantidadeVendaGarrafas" + idVinho).val();
    value++;
    $("#quantidadeVendaGarrafas" + idVinho).val(value);
}

function decrementarValor(idVinho) {
    var value = $("#quantidadeVendaGarrafas" + idVinho).val();
    if (value > 0) {
        value--;
        $("#quantidadeVendaGarrafas" + idVinho).val(value);
    }
}

function abaterGarrafa(idVinho) {

    let dados = new FormData();
    dados.append("op", 13);
    dados.append("idVinho", idVinho);
    dados.append("quantidade", $("#quantidadeVendaGarrafas" + idVinho).val());

    $.ajax({
        url: "controller/controllerVinha.php",
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
            getStock();
            $("#quantidadeVendaGarrafas").val(0);


        } else {
            alerta("Erro", obj.msg, "error");
        }

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });

}

function getAnos1() {

    let dados = new FormData();
    dados.append("op", 14);

    $.ajax({
        url: "controller/controllerVinha.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })


    .done(function (msg) {
        if(msg) {
            $('#anoVindima1').html( msg);
        }
    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });

}

function filtraVinhoAno(idAno) {

    let dados = new FormData();
    dados.append("op", 15);
    dados.append("idAno", idAno);

    $.ajax({
        url: "controller/controllerVinha.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })

    .done(function (msg) {
        $('#corpoTabelaStock').html(msg);

    })

    .fail(function (jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });


}

function removerVindima(id) {

    let dados = new FormData();
    dados.append("op", 16);
    dados.append("id", id);

    $.ajax({
        url: "controller/controllerVinha.php",
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
                getListaVindimas();
                getStock();
            } else {
                alerta("Erro", obj.msg, "error");
            }

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
    getAnos1();
    getStock();
    getCastas();
    getListaVinhas();
    getVinhasSelect();
    getListaVindimas();
    setTimeout(function() {
        $(".js-example-basic-single").select2();
      }, 100);
});