<template>
    <div>
        <table class="table table-hover">
        <thead>
            <tr >
                <th scope="col" v-for="t, key in titulos" :key="key" class="text-uppercase">{{ t }}</th>
            </tr>
        </thead>
            <tbody>
                <tr v-for="m in dados" :key="m.id">
                    <td v-if="titulos.includes(chave)" v-for="valor, chave in m" :key="chave">
                        
                        <span v-if="chave == 'imagem'">
                            <img :src="'/storage/'+valor" :alt="'Logo da marca '+valor" alt="">
                        </span>

                        <span v-else>
                            {{ valor }}
                        </span>
                    </td>
                    <!-- <th scope="row">{{ m.id }}</th>
                    <td>{{m.nome}}</td>
                    <td>
                    <img :src="'/storage/'+m.imagem" :alt="'Logo da marca '+m.nome"></td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props: ['dados', 'titulos']
    }
</script>
