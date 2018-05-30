<template>
    <div>
        <div class="modal fade" id="actualizarConceptoModal" tabindex="-1" role="dialog" aria-labelledby="actualizarConceptoModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="actualizarConceptoModalLabel">Actualizar concepto de nómina</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="frmActualizarConcepto" @submit.prevent="actualizarConcepto" method="post">        
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" required :value="concepto.descripcion">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo">Código</label>
                                    <input type="text" name="tipo_concepto" id="tipo_concepto" class="form-control" required :value="concepto.tipo_concepto">      
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <input type="radio" name="tipo_valor" value="porcentaje" :checked="concepto.porcentaje" v-model="tipo_valor"> Valor %
                                    </label>
                                    <label class="ml-3">
                                        <input type="radio" name="tipo_valor" value="valor_fijo" :checked="concepto.valor_fijo" v-model="tipo_valor"> Monto fijo
                                    </label>                                    
                                    <input type="text" :name="tipo_valor == 'valor_fijo' ? 'valor_fijo' : 'porcentaje'" class="form-control" :value="tipo_valor == 'valor_fijo' ? concepto.valor_fijo : concepto.porcentaje" required>
                                    <small class="text-muted">Ingrese porcentaje o monto según sea el caso</small>
                                </div>
                            </div>
                        </div>  
                        <div class="form-group">
                            <p>Aplica a:</p>
                            <label><input type="checkbox" name="bono_vacacional" id="bono_vacacional" value="1" :checked="concepto.bono_vacacional == '1'"> Bono vacacional</label> <br>
                            <label><input type="checkbox" name="utilidades" id="utilidades" value="1" :checked="concepto.utilidades == '1'"> Utilidades</label> <br>
                            <label><input type="checkbox" name="islr" id="islr" value="1" :checked="concepto.islr == '1'"> ISLR</label> <br>
                            <label><input type="checkbox" name="prestaciones" id="prestaciones" value="1" :checked="concepto.prestaciones == '1'"> Prestaciones sociales</label>
                        </div>  

                        <div class="form-group">
                            <input type="submit" value="Actualizar" class="btn btn-success">
                        </div> 

                        <input type="hidden" name="concepto_id" :value="concepto.concepto_id">
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
    props: ['concepto'],
    data() {
        return {
            tipo_valor: this.concepto.porcentaje !== '' ? 'porcentaje' : 'valor_fijo'
        }
    },
    methods: {
        actualizarConcepto() {            
            const frmActualizarConcepto = document.getElementById('frmActualizarConcepto');
            const formData = new FormData(frmActualizarConcepto);            

            axios.post('/rrhh/backend/mantenimiento/actualizar-concepto', formData)
            .then(response => {
                console.log(response.data)

                $("#actualizarConceptoModal").modal('hide');//ocultamos el modal
                $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
                $('.modal-backdrop').remove();//eliminamos el backdrop del modal

                this.$swal({
                    type: 'success',
                    title: 'Concepto actualizado exitosamente',
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