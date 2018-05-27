<template>
    <div>
        <div class="modal fade" id="agregarConceptoModal" tabindex="-1" role="dialog" aria-labelledby="agregarConceptoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarConceptoModalLabel">Agregar concepto de nómina</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="frmAgregarConcepto" @submit.prevent="registrarConcepto" method="post">
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input type="text" name="tipo_concepto" id="tipo_concepto" class="form-control" required>      
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <input type="radio" name="tipo_valor" value="porcentaje" v-model="tipo_valor" checked="checked"> Valor %
                                    </label>
                                    <label class="mr-3">
                                        <input type="radio" name="tipo_valor" value="valor_fijo" v-model="tipo_valor"> Monto fijo
                                    </label>                                    
                                    <input type="text" :name="tipo_valor == 'valor_fijo' ? 'valor_fijo' : 'porcentaje'" class="form-control" required>
                                    <small class="text-muted">Ingrese porcentaje o monto según sea el caso</small>
                                </div>
                            </div>
                        </div>  
                        <div class="form-group">
                            <p>Aplica a:</p>
                            <label><input type="checkbox" name="bono_vacacional" id="bono_vacacional" value="1"> Bono vacacional</label> <br>
                            <label><input type="checkbox" name="utilidades" id="utilidades" value="1"> Utilidades</label> <br>
                            <label><input type="checkbox" name="islr" id="islr" value="1"> ISLR</label> <br>
                            <label><input type="checkbox" name="prestaciones" id="prestaciones" value="1"> Prestaciones sociales</label>
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
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);

export default {
    data() {
        return {
            tipo_valor: null
        }
    },
    methods: {
        registrarConcepto() {
            const frmAgregarConcepto = document.getElementById('frmAgregarConcepto');
            const formData = new FormData(frmAgregarConcepto);

            axios.post('/rrhh/backend/mantenimiento/registrar-concepto', formData)
            .then(response => {
                console.log(response.data)

                $("#agregarConceptoModal").modal('hide');//ocultamos el modal
                $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                this.$swal({
                    type: 'success',
                    title: 'Concepto registrado exitosamente',
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