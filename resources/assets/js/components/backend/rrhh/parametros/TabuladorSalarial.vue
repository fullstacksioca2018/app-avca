<template>
    <div>
        <div class="float-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AgregarTabuladorModal">
                <i class="fa fa-plus-square"></i> Tabulador
            </button>
        </div>
        <transition name="fade" tag="table">
            <table class="table table-striped">
                <thead>
                    <tr class="text-left">                        
                        <th>Código</th>
                        <th>Nivel</th>
                        <th>Sueldo base</th>
                        <th class="text-center">-</th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        v-for="tabulador in tabuladores"
                        :key="tabulador.id"
                        class="text-left">
                        <td>{{ tabulador.cod_nivel }}</td>
                        <td class="text-left">{{ tabulador.nivel | textCapitalize }}</td>
                        <td>{{ tabulador.sueldo_base }}</td>
                        <td class="text-center">
                            <button class="btn btn-info" data-toggle="modal" data-target="#ActualizarTabuladorModal" @click.prevent="obtenerTabulador(tabulador.tabulador_salarial_id)">
                                <i class="fa fa-cog"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </transition>
        <agregar-tabulador-modal @store="refrescarListado"></agregar-tabulador-modal>
        <actualizar-tabulador-modal :tabulador="tabulador" @update="refrescarListado"></actualizar-tabulador-modal>
    </div>
</template>

<script>
    import AgregarTabuladorModal from './AgregarTabuladorModal';
    import ActualizarTabuladorModal from './ActualizarTabuladorModal';
    export default {
        name: 'TabuladorSalarial',
        components: {AgregarTabuladorModal, ActualizarTabuladorModal},
        data() {
            return {
                tabuladores: [],
                tabulador: ''
            }
        },
        mounted() {
            this.obtenerTabuladores();
        },
        methods: {
            obtenerTabuladores() {
                axios.get('/rrhh/backend/mantenimiento/obtener-tabuladores')
                .then(response => {
                    console.log(response.data);
                    this.tabuladores = response.data;                    
                })
                .catch(error => {
                    console.log(error)
                })
            },
            obtenerTabulador(tabulador) {
                axios.get(`/rrhh/backend/mantenimiento/obtener-tabulador/${tabulador}`)
                .then(response => {
                    console.log(response.data);
                    this.tabulador = response.data;                    
                })
                .catch(error => {
                    console.log(error)
                })
            },
            refrescarListado(mensaje) {
                if(mensaje == 'success') this.obtenerTabuladores();
            }
        },
        filters: {
            textCapitalize: function(value) {
                return value.charAt(0).toUpperCase() + value.slice(1);
            }
        }
    }
</script>

<style scoped>

</style>