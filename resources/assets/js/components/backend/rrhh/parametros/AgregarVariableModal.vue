<template>
    <div>
        <div class="modal fade" id="agregarVariableModal" tabindex="-1" role="dialog" aria-labelledby="agregarVariableModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarVariableModalLabel">Agregar variable de nómina</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="frmAgregarVariable" @submit.prevent="registrarVariable" method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>              
                        <div class="form-group">
                            <label class="mr-3">
                                <input type="radio" name="tipo_valor" value="valor" v-model="tipo_valor" checked="checked"> Valor %
                            </label>
                            <label class="mr-3">
                                <input type="radio" name="tipo_valor" value="monto_fijo" v-model="tipo_valor"> Monto fijo
                            </label>                                    
                            <input type="text" :name="tipo_valor == 'monto_fijo' ? 'monto_fijo' : 'valor'" class="form-control" required>
                            <small class="text-muted">Ingrese porcentaje o monto según sea el caso</small>
                        </div>
                        <div class="form-group">
                            <label for="base_calculo">Base de cálculo</label>
                            <input type="text" name="base_calculo" id="base_calculo" class="form-control" required>
                        </div>                         

                        <div class="form-group">
                            <input type="submit" value="Registrar" class="btn btn-success">
                        </div>                    
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
    data() {
        return {
            tipo_valor: null
        }
    },
    methods: {
        registrarVariable() {
            const frmAgregarVariable = document.getElementById('frmAgregarVariable');
            const formData = new FormData(frmAgregarVariable);

            axios.post('/rrhh/backend/mantenimiento/registrar-variable', formData)
            .then(response => {
                console.log(response.data)

                $("#agregarVariableModal").modal('hide');//ocultamos el modal
                $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                this.$swal({
                    type: 'success',
                    title: 'Variable registrada exitosamente',
                    showConfirmButton: true,
                });

                this.$emit('store', 'success');
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