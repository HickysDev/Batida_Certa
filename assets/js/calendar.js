$(document).ready(function () {
    var calendarEl = document.getElementById('calendar');

    // Mostra o loader
    $('#calendarLoader').show();
    $('#calendar').hide();

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth',
        locale: 'pt-br',
        firstDay: 1,
        showNonCurrentDates: false,
        fixedWeekCount: false,
        headerToolbar: {
            left: 'prev,next today',
            right: 'title',
        },
        buttonText: {
            today: 'Hoje',
            month: 'Mês',
            week: 'Semana',
            day: 'Dia',
            list: 'Lista'
        },
        views: {
            listWeek: {
                buttonText: 'Lista'
            }
        },

        windowResize: function (view) {
            if (window.innerWidth < 768) {
                calendar.changeView('listWeek');
            } else {
                calendar.changeView('dayGridMonth');
            }
        },

        eventContent: function (arg) {
            let title = arg.event.title;

            let container = document.createElement('div');
            container.style.display = 'flex';
            container.style.alignItems = 'center';
            container.style.justifyContent = 'space-between';
            container.style.width = '100%';
            container.style.marginLeft = '8px';
            container.style.marginRight = '8px';

            let titleEl = document.createElement('div');
            titleEl.innerText = title;

            titleEl.style.flexGrow = '1';
            titleEl.style.paddingRight = '10px';

            // Aqui o importante: para o texto quebrar e não sair do container
            titleEl.style.whiteSpace = 'normal';  // permite quebra de linha
            titleEl.style.wordBreak = 'break-word';  // quebra palavras grandes
            titleEl.style.overflowWrap = 'break-word'; // reforça quebra de palavras

            container.appendChild(titleEl);

            if (!arg.event.extendedProps.isFeriado) {
                let btn = document.createElement('button');
                btn.className = 'btn btn-sm btn-warning';
                btn.title = 'Editar ponto';
                btn.style.flexShrink = '0';
                btn.innerHTML = `<i class="bi bi-pencil"></i>`;

                btn.addEventListener('click', function (ev) {
                    ev.stopPropagation();
                    abrirModalEdicao(arg.event.id);
                });

                container.appendChild(btn);
            }

            return { domNodes: [container] };
        },

        events: function (fetchInfo, successCallback, failureCallback) {
            $.when(
                $.ajax({ url: 'api/feriados.php', method: 'GET', dataType: 'json' }),
                $.ajax({ url: 'api/pontos.php', method: 'GET', dataType: 'json' })
            ).done(function (feriadosData, pontosData) {
                var feriados = feriadosData[0];
                var pontos = pontosData[0];
                var eventos = feriados.concat(pontos);
                successCallback(eventos);

                // Esconde loader, mostra o calendário
                $('#calendarLoader').hide();
                $('#calendar').show();

                calendar.render();
            }).fail(function () {
                failureCallback();
            });
        }
    });

    function abrirModalEdicao(id) {

        $("#modalAlterarBaterPonto").modal('show');

        $.ajax({
            url: 'controller/PontoController.php',
            method: 'POST',
            data: {
                acao: 'buscarPonto',
                id: id
            },
            dataType: 'json',
            success: function (res) {
                $("#dataPontoAlterar").val(res.data);
                $("#tipoPontoAlterar").val(res.tipo);
                $("#horaPontoAlterar").val(res.hora);

                $("#btnSalvarEdicao").attr('data-id', res.id); // Aqui setamos o data-id
            },
            error: function () {
                toastr.error('Erro inesperado ao atualizar o ponto.');
            }
        });
    }


    // Salvar novo ponto
    $('#btnSalvarPonto').on('click', function () {
        var data = $('#dataPonto').val();
        var tipo = $('#tipoPonto').val();
        var hora = $('#horaPonto').val();

        if (!data || !tipo || !hora) {
            toastr.error('Preencha todos os campos!');
            return;
        }

        // Mostra o loader
        $('#calendarLoader').show();
        $('#calendar').hide();

        $.ajax({
            url: 'controller/PontoController.php',
            method: 'POST',
            data: {
                acao: "cadastrarPonto",
                dataPonto: data,
                tipo: tipo,
                hora: hora,
            },
            dataType: 'json',
            success: function (res) {
                if (res.status === 'ok') {
                    toastr.success('Ponto salvo com sucesso!');
                    $('#modalBaterPonto').modal('hide');
                    $('#formBaterPonto')[0].reset();
                    calendar.refetchEvents();
                } else {
                    toastr.error('Erro ao salvar ponto: ' + res.mensagem);
                }
            },
            error: function (xhr, status, error) {
                console.error('Erro na requisição AJAX:', error);
                toastr.error('Erro inesperado ao salvar o ponto.');
            }
        });
    });

    // Salvar edição do ponto
    $('#btnSalvarEdicao').on('click', function () {
        var data = $('#dataPontoAlterar').val();
        var tipo = $('#tipoPontoAlterar').val();
        var hora = $('#horaPontoAlterar').val();
        var id = $('#btnSalvarEdicao').data('id');

        if (!data || !tipo || !hora) {
            toastr.error('Preencha todos os campos!');
            return;
        }

        // Mostra o loader
        $('#calendarLoader').show();
        $('#calendar').hide();

        $.ajax({
            url: 'controller/PontoController.php',
            method: 'POST',
            data: {
                acao: 'atualizarPonto',
                dataPonto: data,
                tipo: tipo,
                hora: hora,
                id: id
            },
            dataType: 'json',
            success: function (res) {
                if (res.status === 'ok') {
                    toastr.success('Ponto atualizado com sucesso!');
                    $('#modalAlterarBaterPonto').modal('hide');
                    calendar.refetchEvents();
                } else {
                    toastr.error('Erro ao atualizar ponto: ' + res.mensagem);
                }
            },
            error: function () {
                toastr.error('Erro inesperado ao atualizar o ponto.');
            }
        });
    });
});
