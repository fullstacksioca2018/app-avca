<template>
    <div class="modal fade" id="AgregarTabuladorModal" tabindex="-1" role="dialog" aria-labelledby="AgregarTabuladorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AgregarTabuladorModalLabel">Agregar nivel de tabulador salarial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="frmAgregarTabulador" @submit.prevent="registrarTabulador" method="post">
                    <div class="form-group">
                        <label for="cod_nivel">Código nivel</label>
                        <input type="text" name="cod_nivel" id="cod_nivel" class="form-control" required>
                    </div>                    
                    <div class="form-group">
                        <label for="nivel">Nivel</label>
                        <input type="text" name="nivel" id="nivel" class="form-control" required>      
                    </div>
                    <div class="form-group">
                        <label for="sueldo_base">Sueldo base</label>
                        <input type="text" name="sueldo_base" id="sueldo_base" class="form-control" required>
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
</template>

<script>
    export default {
        methods: {
            registrarTabulador() {
                const frmAgregarTabulador = document.getElementById('frmAgregarTabulador');
                const formData = new FormData(frmAgregarTabulador);

                axios.post('/rrhh/backend/mantenimiento/registrar-tabulador', formData)
                .then(response => {
                    console.log(response.data)

                    $("#AgregarTabuladorModal").modal('hide');//ocultamos el modal
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
    }
</script>

<style scoped>

</style>