$(document).ready(function () {
    $(document).ready(function () {
        var $body = $('body');
        var $botaoModoEscuro = $('.botaoModoEscuro');

        // Se quiser lembrar a preferência do usuário (localStorage)
        if (localStorage.getItem('modoEscuro') === 'true') {
            $body.addClass('modo-escuro');
            $botaoModoEscuro.html('<i class="bi bi-sun-fill"></i>'); // ícone do sol para modo escuro ativo
        }

        $botaoModoEscuro.on('click', function (e) {
            e.preventDefault();
            $body.toggleClass('modo-escuro');

            var modoAtivo = $body.hasClass('modo-escuro');

            if (modoAtivo) {
                $botaoModoEscuro.html('<i class="bi bi-sun-fill"></i>'); // sol (modo escuro ligado)
            } else {
                $botaoModoEscuro.html('<i class="bi bi-moon-fill"></i>'); // lua (modo claro)
            }

            // Salvar preferência do usuário
            localStorage.setItem('modoEscuro', modoAtivo);
        });
    });


    $('#modalJornadaBtn').on('click', function () {
        $.ajax({
            url: 'controller/JornadaController.php',
            method: 'POST',
            data: {
                acao: 'buscaJornada',
                codigoUsuario: 1
            },
            dataType: 'json',
            success: function (res) {
                if (res && res.length > 0) {
                    var busca = res[0];

                    $("#horaEntrada").val(busca.hora_inicio);
                    $("#horaAlmoco").val(busca.tempo_almoco);
                    $("#horaSaida").val(busca.hora_fim);
                }
            },
            error: function () {
                toastr.error('Erro inesperado ao buscar jornada.');
            }, complete() {
                $("#modalJornada").modal("show");
            }
        });
    });


    $("#btnSalvarJornada").click(function () {
        var horaEntrada = $("#horaEntrada").val();
        var horaAlmoco = $("#horaAlmoco").val();
        var horaSaida = $("#horaSaida").val();

        $.ajax({
            url: 'controller/JornadaController.php',
            method: 'POST',
            data: {
                acao: 'cadastrarJornada',
                horaInicio: horaEntrada,
                horaAlmoco: horaAlmoco,
                horaFim: horaSaida,
            },
            dataType: 'json',
            success: function (res) {
                if (res.status === 'ok') {
                    toastr.success('Jornada salva com sucesso!');
                } else {
                    toastr.error('Erro ao salvar jornada: ' + res.mensagem);
                }
            },
            error: function () {
                toastr.error('Erro inesperado ao salvar a jornada.');
            }
        });
    })
})