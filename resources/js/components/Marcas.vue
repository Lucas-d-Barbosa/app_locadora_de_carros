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
                        <table-component 
                            :dados="marcas.data" 
                            :titulos="{
                                id: {titulo: 'ID', tipo: 'text'},
                                nome: {titulo: 'Noma da Marca', tipo: 'text'},
                                imagem: {titulo: 'Imagem', tipo: 'imagem'},
                                created_at: {titulo: 'Data de criação', tipo: 'data'},
                                }"
                                >
                        </table-component>
                    </template>

                    <template v-slot:rodape>
                        <div class="row">
                            <div class="col-10">
                                <paginate-component>
                                    <li v-for="l, key in marcas.links" :key="key">
                                        <a href="" class="page-link" v-html="l.label"></a>
                                    </li>
                                </paginate-component>
                            </div>
                            <div class="col">
                              <button  type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#modalMarca">Adicionar</button>
                            </div>
                        </div>
                    </template>
                </card-component>
                <!--Fim do card de listagem de marcas-->

            </div>
        </div>

        <!-- Modal -->
        <modal-component id="modalMarca" titulo="Adicionar Marca">
            <template v-slot:alertas>
                <alert-component tipo="success" :detalhes="transacaoDetalhes" titulo="Cadastro realizado com sucesso!" v-if="transacaoStatus == 'adicionado'"></alert-component>
                <alert-component tipo="danger" :detalhes="transacaoDetalhes" titulo="Erro ao tentar cadastrar essa marca." v-if="transacaoStatus == 'erro'"></alert-component>
            </template>
            <template v-slot:conteudo>
                <form action="">
                    <input-container-component titulo="Nome da marca" id="novoNome" id-help="novoNomeHelp" texto-ajuda="Informe o nome da marca.">
                        <input type="text" class="form-control" id="inputNome" aria-describedby="novoNomeHelp" placeholder="Nome da marca" v-model="nomeMarca">
                    </input-container-component>
                    <input-container-component titulo="Imagem" id="novaImagem" id-help="novaImagemHelp" texto-ajuda="Selecione uma imagem no formato PNG.">
                        <input type="file" class="form-control" id="novaImagem" aria-describedby="novaImagemHelp" placeholder="Selecione uma imagem." @change="carregarImagem($event)">
                    </input-container-component>

                </form>
            </template>
            <template v-slot:rodape>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" @click="salvar()">Salvar</button>
            </template>
        </modal-component>

    </div>
</template>

<script>
import axios from 'axios';
import { computed } from 'vue';

    export default {
        data(){
            return {
                urlBase: 'http://localhost:8001/api/v1/marca',
                nomeMarca: '',
                arquivoImagem: [],
                transacaoStatus: '',
                transacaoDetalhes: {},
                marcas: {data: []}
            }
        },
        computed: {
            token() {
                const tokenCookie = document.cookie.split(';').find(indice => indice.trim().startsWith('token='));
                if (!tokenCookie) {
                    console.error('Token não encontrado nos cookies.');
                    return null; // Ou retorne uma string vazia caso necessário
                }
                const tokenValue = tokenCookie.split('=')[1];
                return `Bearer ${tokenValue}`;
            }
        },
        methods:{
            carregarLista(){
                let config = {
                    headers:{
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }

                axios.get(this.urlBase, config)
                    .then(response => {
                        this.marcas = response.data
                        // console.log(response.data);
                    })
                    .catch(errors => {
                        console.log(errors);
                    })
            },
            carregarImagem(e){
                this.arquivoImagem = e.target.files
            },
            salvar(){
                let formData = new FormData()
                formData.append('nome', this.nomeMarca)
                formData.append('imagem', this.arquivoImagem[0])
                let config = {
                    headers:{
                        'Content-Type' : 'multipart/form-data',
                        'Accept': 'application/json',
                        'Authorization': this.token
                    }
                }
                axios.post(this.urlBase, formData, config)
                    .then(response => {
                        this.transacaoStatus = "adicionado"
                        this.transacaoDetalhes = {
                           mensagem: "ID do registro: " + response.data.id 
                        }
                        console.log(response)
                    })
                    .catch(errors => {
                        this.transacaoStatus = "erro"
                        this.transacaoDetalhes = {
                            mensagem: errors.response.data.message,
                            dados: errors.response.data.errors
                            
                        }

                        // errors.response.data.message
                    })
            }
        },
        mounted() {
            this.carregarLista()
        }
    }
</script>

