<?php
require_once 'view/layout/head.php';
?>

<div class="mx-5">
    <div class="d-flex justify-content-between align-items-center mb-3 my-3">
        <h2>Agenda de Ponto</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBaterPonto">
            + Bater Ponto
        </button>
    </div>

    <!-- Loader -->
    <div id="calendarLoader" class="text-center my-5">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Carregando...</span>
        </div>
    </div>

    <!-- Calendário -->
    <div id="calendar"></div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalBaterPonto" tabindex="-1" aria-labelledby="modalBaterPontoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formBaterPonto">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalBaterPontoLabel">Nova Marcações de Ponto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="dataPonto" class="form-label">Data</label>
                        <input type="date" class="form-control" id="dataPonto" name="data" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipoPonto" class="form-label">Tipo de Ponto</label>
                        <select class="form-select" id="tipoPonto" name="tipo" required>
                            <option value="">Selecione...</option>
                            <option value="chegada">Chegada</option>
                            <option value="saida_almoco">Saída Almoço</option>
                            <option value="volta_almoco">Volta Almoço</option>
                            <option value="saida_dia">Saída do Dia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="horaPonto" class="form-label">Hora</label>
                        <input type="time" class="form-control" id="horaPonto" name="hora" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnSalvarPonto" type="button" class="btn btn-primary">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalAlterarBaterPonto" tabindex="-1" aria-labelledby="modalAlterarBaterPontoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="formBaterPonto">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAlterarBaterPontoLabel">Editar Marcação de Ponto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="dataPontoAlterar" class="form-label">Data</label>
                        <input type="date" class="form-control" id="dataPontoAlterar" name="data" value="<?= date('Y-m-d') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipoPontoAlterar" class="form-label">Tipo de Ponto</label>
                        <select class="form-select" id="tipoPontoAlterar" name="tipo" required>
                            <option value="">Selecione...</option>
                            <option value="chegada">Chegada</option>
                            <option value="saida_almoco">Saída Almoço</option>
                            <option value="volta_almoco">Volta Almoço</option>
                            <option value="saida_dia">Saída do Dia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="horaPontoAlterar" class="form-label">Hora</label>
                        <input type="time" class="form-control" id="horaPontoAlterar" name="hora" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnSalvarEdicao" data-id="" type="button" class="btn btn-primary">Alterar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </form>
    </div>
</div>


<?php
require_once 'view/layout/footer.php';
?>