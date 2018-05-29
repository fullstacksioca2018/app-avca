<template>
    <div>
        <div class="float-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarConceptoModal">
                <i class="fa fa-plus-square"></i> Concepto
            </button>
        </div>
        <transition name="fade" tag="table">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Valor %</th>
                        <th>Monto fijo</th>
                        <th>Bono vacacional</th>
                        <th>Utilidades</th>
                        <th>Prestaciones sociales</th>
                        <th>ISLR</th>
                        <th>-</th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        v-for="concepto in conceptos"
                        :key="concepto.id"
                        class="text-center">
                        <td>{{ concepto.tipo_concepto }}</td>
                        <td class="text-left">{{ concepto.descripcion }}</td>
                        <td>
                            <span v-if="concepto.porcentaje !== null">
                                {{ concepto.porcentaje }}
                            </span>
                            <span v-else class="text-muted">
                                N/A
                            </span>
                        </td>
                        <td>
                            <span v-if="concepto.valor_fijo !== null">
                                {{ concepto.valor_fijo }}
                            </span>
                            <span v-else class="text-muted">
                                N/A
                            </span>
                        </td>
                        <td>
                            <span v-if="concepto.bono_vacacional === 1" class="text-success">
                                <i class="fa fa-check"></i>
                            </span>
                            <span v-else class="text-danger">
                                <i class="fa fa-close"></i>
                            </span>
                        </td>
                        <td>
                            <span v-if="concepto.utilidades === 1" class="text-success">
                                <i class="fa fa-check"></i>
                            </span>
                            <span v-else class="text-danger">
                                <i class="fa fa-close"></i>
                            </span>                            
                        </td>
                        <td>
                            <span v-if="concepto.prestaciones === 1" class="text-success">
                                <i class="fa fa-check"></i>
                            </span>
                            <span v-else class="text-danger">
                                <i class="fa fa-close"></i>
                            </span>
                        </td>
                        <td>
                            <span v-if="concepto.islr === 1" class="text-success">
                                <i class="fa fa-check"></i>
                            </span>
                            <span v-else class="text-danger">
                                <i class="fa fa-close"></i>
                            </span>
                        </td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#actualizarConceptoModal" @click.prevent="obtenerConcepto(concepto.concepto_id)">
                                <i class="fa fa-cog"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </transition>
        <agregar-concepto-modal @store="refrescarListado"></agregar-concepto-modal>
        <actualizar-concepto-modal :concepto="concepto" @update="refrescarListado"></actualizar-concepto-modal>
    </div>
</template>

<script>
    import AgregarConceptoModal from './AgregarConceptoModal';
    import ActualizarConceptoModal from './ActualizarConceptoModal';
    export default {
        name: 'Conceptos',
        components: {AgregarConceptoModal, ActualizarConceptoModal},
        data() {
            return {
                conceptos: [],
                concepto: ''
            }
        },
        mounted() {
            this.obtenerConceptos();
        },
        methods: {
            obtenerConceptos() {
                axios.get('/rrhh/backend/mantenimiento/obtener-conceptos')
                .then(response => {
                    console.log(response.data);
                    this.conceptos = response.data;                    
                })
                .catch(error => {
                    console.log(error)
                })
            },
            obtenerConcepto(concepto) {
                axios.get('/rrhh/backend/mantenimiento/obtener-concepto/'+concepto)
                .then(response => {
                    console.log(response.data);
                    this.concepto = response.data;                    
                })
                .catch(error => {
                    console.log(error)
                })
            },
            refrescarListado(mensaje) {
                if(mensaje == 'success') this.obtenerConceptos();
            }
        },
    }
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>