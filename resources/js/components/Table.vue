<template>
    <div>
        <table class="table table-hover">
        <thead>
            <tr >
                <th scope="col" v-for="t, key in titulos" :key="key">{{ t.titulo }}</th>
            </tr>
        </thead>
            <tbody>
               <tr v-for="obj, chave in dadosFiltrados" :key="chave">
                    <td v-for="valor, chaveValor in obj" :key="chaveValor">
                        <span v-if="titulos[chaveValor].tipo == 'text'">
                            {{ valor }}
                        </span>
                        <span v-if="titulos[chaveValor].tipo == 'imagem'">
                            <img :src="'/storage/'+valor"  >
                        </span>
                        <span v-if="titulos[chaveValor].tipo == 'data'">
                            {{ valor }}
                        </span>


                    </td>
               </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['dados', 'titulos'],
        computed: {
            dadosFiltrados()
            {
                let campos = Object.keys(this.titulos);
                let dadosArrayFiltrados = []
                this.dados.map((item, chave) => {
                
                    let itemFiltrado = {}
                    campos.forEach(campo => {
                        itemFiltrado[campo] = item[campo]
                    })
                    dadosArrayFiltrados.push(itemFiltrado);

                })
                return dadosArrayFiltrados;
            }
        }
    }
</script>
