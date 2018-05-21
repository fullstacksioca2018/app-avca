<template>
    <!-- Modal -->
    <div class="modal fade" id="actualizarSucursalModal" tabindex="-1" role="dialog" aria-labelledby="actualizarSucursalModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="actualizarSucursalModal">Actualizar sucursal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" method="post" id="sucursalFrm" @submit.prevent="actualizarSucursal">                        
                        <div class="form-group">
                            <label for="nombre">Sucursal</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" :value="sucursal.nombre">
                        </div>
                        <div class="row">
                            <div class="col-md-6">                        
                                <div class="form-group">
                                    <label for="nombre">Ciudad</label>
                                    <input type="text" name="ciudad" id="ciudad" class="form-control" :value="sucursal.ciudad">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo_sucursal">Tipo</label>
                                    <select name="tipo_sucursal" id="tipo_sucursal" class="form-control">             
                                        <option value="administrativa" :selected="sucursal.tipo_sucursal === 'administrativa'">Administrativa</option>
                                        <option value="operativa" :selected="sucursal.tipo_sucursal === 'operativa'">Operativa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Actualizar" class="btn btn-success">
                        </div>
                        <input type="hidden" name="sucursal_id" :value="sucursal.sucursal_id">
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
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

export default {
    props: ['sucursal'],
    methods: {
        actualizarSucursal() {
            const sucursalFrm = document.getElementById('sucursalFrm');
            const formData = new FormData(sucursalFrm);
            axios.post('/rrhh/backend/mantenimiento/actualizar-sucursal', formData)
            .then(response => {
                console.log(response.data);
                $("#actualizarSucursalModal").modal('hide');//ocultamos el modal
                $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                this.$swal({
                    type: 'success',
                    title: 'Sucursal actualizada exitosamente',
                    showConfirmButton: true,
                });
            })
            .catch(error => {
                console.log(error);
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