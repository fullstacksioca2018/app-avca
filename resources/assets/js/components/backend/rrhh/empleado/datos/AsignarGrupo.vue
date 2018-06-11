<template>
    <div>
        <div class="row">
            <div class="col-md-4 offset-md-4">                
                <div class="form-group">
                    <label for="grupo">Elijar el grupo a asignar</label>
                    <select name="grupo" id="grupo" class="form-control" v-model="grupo" @change.prevent="actualizarGrupo">
                        <option 
                            :value="grupo.id"
                            v-for="grupo in grupos"
                            :key="grupo.id"
                            :selected="grupo.id == empleado.grupo_id">
                            {{ grupo.nombre }}
                        </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'AsignarGrupo',
        props: ['empleado'],
        data() {
            return {
                grupos: [],
                grupo: this.empleado.grupo_id
            }
        },
        mounted() {
            this.obtenerGrupos();
        },
        methods: {
            obtenerGrupos() {
                axios.get('/rrhh/backend/sucursal/obtener-grupos')
                    .then(response => {
                        this.grupos = response.data
                    })
                    .catch(error => {
                        console.error(error)
                    })
            },
            actualizarGrupo() {
                axios.get(`/rrhh/backend/sucursal/actualizar-grupo/${this.grupo}`, {
                    params: {
                        empleado_id: this.empleado.empleado_id
                    }
                })
                    .then(response => {
                        console.log(response.data)
                        this.$swal({                            
                            type: 'success',
                            title: response.data,
                            showConfirmButton: true,                            
                        });
                    })
                    .catch(error => {
                        console.error(error)
                        this.$swal({                            
                            type: 'warning',
                            title: 'Ha ocurrido un error. Intente nuevamente.',
                            showConfirmButton: true,                            
                        });
                    })
            }
        },
        
    }
</script>

<style scoped>

</style>