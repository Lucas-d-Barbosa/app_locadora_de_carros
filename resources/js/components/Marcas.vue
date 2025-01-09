<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!--Inicio do card de busca-->
                <card-component titulo="Buscar Marca">
                    <template v-slot:conteudo>
                        <div class="form-row">
                            
                            <div class="col mb-3">
                                <input-container-component titulo="ID" id="inputId" id-help="idHelp" texto-ajuda="Opcional. Informe o ID do registro.">
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID">
                                </input-container-component>
                            </div>
                            <div class="col mb-3">
                                <input-container-component titulo="Nome da marca" id="inputNome" id-help="nomeHelp" texto-ajuda="Opcional. Informe o nome da marca.">
                                    <input type="text" class="form-control" id="inputNome" aria-describedby="nomeHelp" placeholder="Nome da marca">
                                </input-container-component>
                            </div>
                        </div>
                    </template>
                    <template v-slot:rodape>
                        <button type="submit" class="btn btn-primary btn-sm float-end">Pesquisar</button>
                    </template>
                </card-component>
                <!--Fim do card de busca-->

                <!--Inicio do card de listagem de marcas-->
                <card-component titulo="Relação de Marcas">
                    <template v-slot:conteudo>
                        <table-component></table-component>
                    </template>
                    <template v-slot:rodape>
                        <button  type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalMarca">Adicionar</button>
                    </template>
                </card-component>
                <!--Fim do card de listagem de marcas-->

            </div>
        </div>

        <!-- Modal -->
        <modal-component id="modalMarca" titulo="Adicionar Marca">
            <template v-slot:conteudo>
                <form action="">
                    <input-container-component titulo="Nome da marca" id="novoNome" id-help="novoNomeHelp" texto-ajuda="Informe o nome da marca.">
                        <input type="text" class="form-control" id="inputNome" aria-describedby="novoNomeHelp" placeholder="Nome da marca">
                    </input-container-component>
                    <input-container-component titulo="Imagem" id="novaImagem" id-help="novaImagemHelp" texto-ajuda="Selecione uma imagem no formato PNG.">
                        <input type="file" class="form-control" id="novaImagem" aria-describedby="novaImagemHelp" placeholder="Selecione uma imagem.">
                    </input-container-component>
                </form>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar</button>
            </template>
        </modal-component>

    </div>
</template>

<script>

</script>

