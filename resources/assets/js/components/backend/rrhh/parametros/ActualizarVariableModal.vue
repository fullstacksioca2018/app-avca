<template>
    <div>
        <div class="modal fade" id="ActualizarVariableModal" tabindex="-1" role="dialog" aria-labelledby="ActualizarVariableModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ActualizarVariableModalLabel">Actualizar variable de nómina</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="frmActualizarVariable" @submit.prevent="actualizarVariable" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required :value="variable.nombre">
                        </div>              
                        <div class="form-group">
                            <label class="mr-3">
                                <input type="radio" name="tipo_valor" value="valor" :checked="variable.valor" v-model="tipo_valor"> Valor %
                            </label>
                            <label class="mr-3">
                                <input type="radio" name="tipo_valor" value="monto_fijo" :checked="variable.monto_fijo" v-model="tipo_valor"> Monto fijo
                            </label>                                    
                            <input type="text" :name="tipo_valor == 'monto_fijo' ? 'monto_fijo' : 'valor'" class="form-control" :value="tipo_valor == 'monto_fijo' ? variable.monto_fijo : variable.valor" required>
                            <small class="text-muted">Ingrese porcentaje o monto según sea el caso</small>
                        </div>
                        <div class="form-group">
                            <label for="base_calculo">Base de cálculo</label>
                            <input type="text" name="base_calculo" id="base_calculo" class="form-control" required :value="variable.base_calculo">
                        </div>                         

                        <div class="form-group">
                            <input type="submit" value="Actualizar" class="btn btn-success">
                        </div>

                        <input type="hidden" name="variable_id" :value="variable.variable_id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>                    
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['variable'],
    data() {
        return {
            tipo_valor: this.variable.valor !== '' ? 'valor' : 'monto_fijo'
        }
    },
    methods: {
        actualizarVariable() {            
            const frmActualizarVariable = document.getElementById('frmActualizarVariable');
            const formData = new FormData(frmActualizarVariable);            

            axios.post('/rrhh/backend/mantenimiento/actualizar-variable', formData)
            .then(response => {
                console.log(response.data)

                $("#ActualizarVariableModal").modal('hide');//ocultamos el modal
                $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                this.$swal({
                    type: 'success',
                    title: 'Variable actualizado exitosamente',
                    showConfirmButton: true,
                });

                this.$emit('update', 'success');
            })
            .catch(error => {
                console.log(error)

                this.$swal({
                    type: 'warning',
                    title: 'Ocurrió un error. Por favor intente nuevamente',
                    showConfirmButton: true,
                });
            })
        }
    },
};
</script>

<style scoped>
</style>