<template>
    <div class="modal fade" id="ActualizarTabuladorModal" tabindex="-1" role="dialog" aria-labelledby="ActualizarTabuladorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ActualizarTabuladorModalLabel">Actualizar nivel de tabulador salarial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="frmActualizarTabulador" @submit.prevent="actualizarTabulador" method="post">
                    <div class="form-group">
                        <label for="cod_nivel">Código nivel</label>
                        <input type="text" name="cod_nivel" id="cod_nivel" class="form-control" required :value="tabulador.cod_nivel">
                    </div>                    
                    <div class="form-group">
                        <label for="nivel">Nivel</label>
                        <input type="text" name="nivel" id="nivel" class="form-control" required :value="tabulador.nivel">      
                    </div>
                    <div class="form-group">
                        <label for="sueldo_base">Sueldo base</label>
                        <input type="text" name="sueldo_base" id="sueldo_base" class="form-control" required :value="tabulador.sueldo_base">
                    </div>  

                    <div class="form-group">
                        <input type="submit" value="Actualizar" class="btn btn-success">
                    </div>

                    <input type="hidden" name="tabulador_id" :value="tabulador.tabulador_salarial_id">
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
        props: ['tabulador'],
        methods: {
            actualizarTabulador() {            
            const frmActualizarTabulador = document.getElementById('frmActualizarTabulador');
            const formData = new FormData(frmActualizarTabulador);            

            axios.post('/rrhh/backend/mantenimiento/actualizar-tabulador', formData)
            .then(response => {
                console.log(response.data)

                $("#ActualizarTabuladorModal").modal('hide');//ocultamos el modal
                $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                this.$swal({
                    type: 'success',
                    title: 'Tabulador actualizado exitosamente',
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
    }
</script>

<style scoped>

</style>