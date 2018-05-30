<template>
    <div class="col-12">
        <div class="card">
            <div class="card-header bg-info-gradient">Listado de sucursales</div>
            <div class="card-body">
                <div class="float-right">
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#agregarSucursalModal">
                        <i class="fa fa-plus-square"></i> 
                        Agregar
                    </button>
                </div>
                <div class="clearfix"></div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sucursal</th>
                            <th>Ciudad</th>
                            <th>Tipo</th>
                            <th>Estatus</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>                        
                        <tr class="text-capitalize"
                            v-for="sucursal in sucursales"
                            :key="sucursal.id">
                            <td>{{ sucursal.nombre }}</td>
                            <td>{{ sucursal.ciudad }}</td>
                            <td>{{ sucursal.tipo_sucursal }}</td>
                            <td>{{ sucursal.estatus }}</td>
                            <td>
                                <button class="btn btn-info" data-toggle="modal" data-target="#actualizarSucursalModal">
                                    <i class="fa fa-cog" @click.prevent="obtenerSucursal(sucursal.sucursal_id)"></i>
                                </button>
                            </td>                            
                        </tr>                        
                    </tbody>
                </table>
            </div>
        </div>
        <actualizar-modal :sucursal="sucursal"></actualizar-modal>
    </div>
</template>

<script>
    import ActualizarModal from './ActualizarModal';
    export default {
        name: 'ListadoSucursal',
        props: ['sucursales'],
        components: {ActualizarModal},
        data() {
            return {
                sucursal: ''
            }
        },
        methods: {            
            obtenerSucursal(sucursal) {
                axios.get('/rrhh/backend/mantenimiento/obtener-sucursal/'+sucursal)
                .then(response => {
                    console.log(response.data);
                    this.sucursal = response.data;
                })
                .catch(error => {
                    console.log(error)
                })
            }
        },
    }
</script>

<style scoped>

</style>