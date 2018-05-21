<template>
    <div>
        <div class="float-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarVariableModal">
                <i class="fa fa-plus-square"></i> Variable
            </button>
        </div>
        <transition name="fade" tag="table">
            <table class="table table-striped">
                <thead>
                    <tr class="text-center">                        
                        <th>Nombre</th>
                        <th>Valor</th>
                        <th>Monto fijo</th>
                        <th>Base cálculo</th>                        
                        <th>-</th>
                    </tr>
                </thead>
                <tbody>
                    <tr 
                        v-for="variable in variables"
                        :key="variable.id"
                        class="text-center">
                        <td>{{ variable.nombre }}</td>
                        <td class="text-left">{{ variable.valor }}</td>
                        <td>{{ variable.monto_fijo }}</td>
                        <td>{{ variable.base_calculo }}</td>                        
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#ActualizarVariableModal" @click.prevent="obtenerVariable(variable.variable_id)">
                                <i class="fa fa-cog"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </transition>        
        <agregar-variable-modal @store="refrescarListado"></agregar-variable-modal>
        <actualizar-variable-modal :variable="variable" @update="refrescarListado"></actualizar-variable-modal>
    </div>
</template>

<script>
    import AgregarVariableModal from './AgregarVariableModal';
    import ActualizarVariableModal from './ActualizarVariableModal';
    export default {
        name: 'Variables',
        components: {AgregarVariableModal, ActualizarVariableModal},
        data() {
            return {
                variables: [],
                variable: ''
            }
        },
        mounted() {
            this.obtenerVariables();
        },
        methods: {
            obtenerVariables() {
                axios.get('/rrhh/backend/mantenimiento/obtener-variables')
                .then(response => {
                    console.log(response.data);
                    this.variables = response.data;                    
                })
                .catch(error => {
                    console.log(error)
                })
            },
            obtenerVariable(variable) {
                axios.get(`/rrhh/backend/mantenimiento/obtener-variable/${variable}`)
                .then(response => {
                    console.log(response.data);
                    this.variable = response.data;                    
                })
                .catch(error => {
                    console.log(error)
                })
            },
            refrescarListado(mensaje) {
                if(mensaje == 'success') this.obtenerVariables();
            }
        }
    }
</script>

<style scoped>

</style>